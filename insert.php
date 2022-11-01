<style>
.tabcontent {
    display: none;
}
button.tablinks.active {
    color: red;
}
</style>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>


<?php
$link = mysqli_connect("localhost", "root", "", "demo");

if ($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
    $sql = "INSERT INTO persons (first_name) VALUES ('$first_name')";
    if (mysqli_query($link, $sql))
    {
        $last_id = $link->insert_id;
        echo "Records added successfully.";
    }
    else
    {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
}
$query = "SELECT id FROM persons ORDER BY id DESC LIMIT 1";
$results = $link->query($query);

foreach ($results as $col)
{
    echo $last_id = $col["id"];
}

$sql1 = "SELECT id, first_name   FROM persons";
$result = $link->query($sql1);

if ($result->num_rows > 0)
{ ?>
  
   <div class="tabs_cont">
  <?php

    while ($row = $result->fetch_assoc())
    {
        $id = $row["id"];

?>
  
<div class="tab_inner">
  <button class="tablinks <?php if ($last_id == $id)
        {
            echo 'active';
        } ?>" onclick="openCity(event, '<?php echo $row["first_name"]; ?>')"><?php echo $row["first_name"]; ?></button>
  
  <div id="<?php echo $row["first_name"]; ?>" class="tabcontent" style ="<?php if ($last_id == $id)
        {
            echo 'display : block;';
        } ?>">
  <h3><?php echo $row["first_name"]; ?></h3>
  <p>London is the capital city of England.</p>
</div
</div>
 
 </div> 

  <?php

    }
?>  </div> <?php
}
else
{
    echo "0 results";
}

mysqli_close($link);
?>


<html>
<head>
<title>Add Record Form</title>
</head>
<body>
<form action="" method="post">
    
        <label for="firstName">First Name:</label>
        <input type="text" name="first_name" id="firstName">
    
    <input type="submit" value="Submit">
</form>
</body>
</html>
