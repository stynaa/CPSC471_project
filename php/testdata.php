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
    $i = isa_number($data);
    if ($i) {
      $i = (strlen($data) == 10);
    }
    return $i;
  }

  function isa_username($data) {
    //no more than 15 
    return (strlen($data) < 16);
  }

  function isa_name($data) {
    //no more than 64
    return (strlen($data) < 65 && preg_match("/^[a-zA-Z]*$/",$data));
    //no symbols/numbers
  }
  ?>