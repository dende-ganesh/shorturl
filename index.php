<?php
  include "php/config.php";
  if(isset($_GET['u'])){
      $u = mysqli_real_escape_string($conn, $_GET['u']);
      $sql = mysqli_query($conn, "SELECT full_url FROM url WHERE shorten_url = '{$u}'");
      if(mysqli_num_rows($sql) > 0){
        $sql2 = mysqli_query($conn, "UPDATE url SET clicks = clicks + 1 WHERE shorten_url = '{$u}'");
        if($sql2){
            $full_url = mysqli_fetch_assoc($sql);
            header("Location:".$full_url['full_url']);
          }
      }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Url shortener</title>
    <link rel='stylesheet' href='style.css'>
  </head>
  <body>
    <div class="form">
    <form>
      <input type='text'  name="full-url" placeholder='Enter long url to shorten'>
      <button >shorten</button>
    </form>
    </div>
    <p id='short' style='font-size:20px'></p>
    <script src="script.js"></script>
    <div class="table">
      <table>
        <tr>
          <td>LongUrl</td>
          <td>short Url</td>
          <td>no of clicks</td>
        </tr>

        <?php
          $sql=mysqli_query($conn,"SELECT * from url");
          while($row = mysqli_fetch_assoc($sql)){
            ?><tr>
                  <th><a href="$row['full_url']" target="_blank"><?php echo $row['full_url'] ?></th>
                  <th><a href="$row['$shorten_url']" target="_blank">localhost:8080?u=<?php echo $row['shorten_url'] ?></th>
                  <th><?php echo $row['clicks'] ?></th>
              </tr>
              <?php
            }
          ?>
      </table>
    </div>

  </body>
</html>
