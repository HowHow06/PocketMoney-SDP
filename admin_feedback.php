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
                    <tbody id="feedbackstudio">
                    
                    <?php 
                    
                    $query = $admin->getDataByQuery("SELECT * FROM feedback");
                    
                    if (!empty($query)) {
                    for($i = 0; $i < sizeof($query); $i++) {

                      //loop
                    ?> 
                  
                    <tr>
                    <th scope = "row"><?php echo ($i +1 ); ?></th>
                    <td class="feedback_date"><?php print_r($query[$i]['sent_date']); ?></td>
                    <td class="feedback_customer"><?php echo ($query[$i]['customer_name']); ?></td>
                    <td class="feedback_content"><?php echo ($query[$i]['content']); ?></td>
                    <td class="action">
                                      <a href="#" class="edit-announcement-anchor" data-toggle="modal" data-target="#edit-row">Edit</a>
                                      <span> | </span>
                                      <a href="#" class="delete-announcement-anchor" data-toggle="modal" data-target="#delete-row">Delete</a>
                                  </td>
                    </tr> 
                    <?php }
                   } ?>

                    </tbody>
                  </table>
                    <br><br>
                    <button type="button" class="btn btn-outline-primary reply-feedback">Reply</button>
                    <br>
                </div>

</html>
