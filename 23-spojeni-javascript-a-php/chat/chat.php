<?php
session_start();
ob_start();
header("Content-type: application/json");
@ini_set('display_errors', '0');

date_default_timezone_set('Europe/Prague');

try {

  // Pokusíme se připojit k databázi.
      $host = 'localhost';
	  $user = 'hbstudent';
	  $password = 'hbstudent';
	  $database = 'chat';
	  
	  $db = mysqli_connect($host, $user, $password, $database);

  if (mysqli_connect_errno()) {
    throw new Exception(
      'Nepodařilo se připojit k databázi. Prosíme, zkuste to později.');
  }

  $currentTime = time();
  $session_id = session_id();

  $lastPoll = isset($_SESSION['last_poll']) ?
                $_SESSION['last_poll'] : $currentTime;

  $action = isset($_SERVER['REQUEST_METHOD']) &&
            ($_SERVER['REQUEST_METHOD'] == 'POST') ?
              'send' : 'poll';

  switch ($action) {
    case 'poll':

      $query = "SELECT *
                  FROM chatlog
                  WHERE time_created > ?";

      $stmt = $db->prepare($query);
      $stmt->bind_param('s', $lastPoll);
      $stmt->execute();
      $result = $stmt->get_result();

      $newChats = [];
      while ($chat = $result->fetch_assoc()) {

        if ($session_id == $chat['sent_by']) {
          $chat['sent_by'] = 'self';
        } else {
          $chat['sent_by'] = 'other';
        }

        $newChats[] = $chat;
      }


      $_SESSION['last_poll'] = $currentTime;

      print json_encode([
        'success' => true,
        'messages' => $newChats
      ]);
      exit;

    case 'send':

      $message = isset($_POST['message']) ? $_POST['message'] : '';
      $message = strip_tags($message);

      $query = "INSERT INTO chatlog(message, sent_by, time_created)
                  VALUES (?, ?, ?)";

      $stmt = $db->prepare($query);
      $stmt->bind_param('ssi', $message, $session_id, $currentTime);
      $stmt->execute();

      print json_encode(['success' => true]);
      exit;
  }
} catch(Exception $e) {

  print json_encode([
    'success' => false,
    'error' => $e->getMessage()
  ]);
}
