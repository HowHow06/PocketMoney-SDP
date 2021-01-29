<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/admin.css">
    <title>PockeyMoney | Dashboard</title>
</head>
<body>
    <?php include("AD_navbar.php"); ?>
    <div class="container-fluid background">
      <div class="container-fluid">
          <div class="container-fluid body feedback">
              <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">FEEDBACK STUDIO</a>
                  </nav>

                  <table class="table feedback-table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Feedback ID</th>
                        <th scope="col">Sent Date</th>
                        <th scope="col">Sender Name</th>
                        <th scope="col">Content</th>
                        <th scope="col">ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>1/1/2021</td>
                        <td>Ali</td>
                        <td>Haha</td>
                        <td></td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>1/1/2021</td>
                        <td>Ah Kau</td>
                        <td>Haha</td>
                        <td></td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>1/1/2021</td>
                        <td>Muthu</td>
                        <td>Haha</td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                    <br><br>
                    <button type="button" class="btn btn-outline-primary reply-feedback">Reply</button>
                    <br>
                </div>

<script>
$(document).ready(function () {
    $("body").niceScroll();
    $(".transaction-table").niceScroll();
});
</script>
</html>

