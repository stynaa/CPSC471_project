  <?php
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function isa_number($data) {
    return preg_match("/^[0-9]*$/",$data);
  }

  function isa_phone($data) {
    $i = preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/",$data);
    $j = preg_match("/^[0-9]{10}$/",$data);
    return $i || $j;
  }

  function isa_username($data) {
    //no more than 15
    return (preg_match("/^[a-zA-Z0-9]{0,15}$/",$data));
  }

  function isa_name($data) {
    //no more than 64, only letters, spaces, and dash
    return (strlen($data) < 65 && preg_match("/^[a-zA-Z \-\']*$/",$data));
  }

  function isa_dob($data) {
    //is in the past (at least 4 years old)
    $result = "";
    date_default_timezone_set('America/Edmonton');
    $dateTime = DateTime::createFromFormat('Y-m-d', $data);
    $errors = DateTime::getLastErrors();
    if (!empty($errors['warning_count'])) {
      $result = "Strictly speaking, that date was invalid! Please enter a valid date. ";
    }
    //date_default_timezone_set('America/Edmonton');
    $currentDate = date('Y-m-d', time());
    $cc = DateTime::createFromFormat('Y-m-d', $currentDate);
    if ($cc < $dateTime) {
      $result = $result . 'Date of birth cannot be in the future. Please enter a date of birth in the past. ' ;
    }

    return $result;
  }

  function isa_classname($data) {
    //no more than 64 characters
    return (strlen($data) < 65);
  }

  function isa_postalcode($data) {
    return preg_match("/^[ABCEGHJKLMNPRSTVXY]{1}[0-9]{1}[A-Z]{1} *[0-9]{1}[A-Z]{1}[0-9]{1}$/", $data);
  }

  function isa_starttime($data) {
    //is in the future
    $result = "";
    date_default_timezone_set('America/Edmonton');
    $dateTime = DateTime::createFromFormat('Y-m-d*H:i', $data);
    $errors = DateTime::getLastErrors();
    if (!empty($errors['warning_count'])) {
      $result = "Strictly speaking, that date was invalid! Please enter a valid start time. " . $data;
    }
    $currentDate = date('Y-m-d*H:i', time());
    $cc = DateTime::createFromFormat('Y-m-d*H:i', $currentDate);
    if ($cc > $dateTime) {
      $result = $result . "Please enter a start time in the future. ";
    }

    return $result;
  }

  function isa_endtime($data, $st) {
    //is after starttime
    $result = "";
    date_default_timezone_set('America/Edmonton');
    $dateTime = DateTime::createFromFormat('Y-m-d*H:i', $data);
    $errors = DateTime::getLastErrors();
    if (!empty($errors['warning_count'])) {
      $result = "Strictly speaking, that date was invalid! Please enter a valid end time. " . $data;
    }
    $startTime = DateTime::createFromFormat('Y-m-d*H:i', $st);

    //test stuff
    $currentDate = date('Y-m-d H:i', time());
    $st = $startTime->format('Y-m-d H:i');
    $cc = DateTime::createFromFormat('Y-m-d*H:i', $currentDate);
    if ($startTime < $cc) {
      $txt = " Start date is before current date. ";
    }
    //end of test stuff

    if ($startTime > $dateTime) {
      $result = $result . "Please enter an end time after the start time. " ;
    }

    return $result;
  }

  function isa_comment($data) {
    return (strlen($data) < 501);
  }

  function isa_rating($data) {
    return (isa_number($data) && $data >= 1 && $data <= 10);
  }

  function isa_emptyspace($data) {
    return preg_match("/^ *$/", $data);
  }
  ?>
