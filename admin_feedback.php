<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/admin.css">
    <link rel="stylesheet" href="./style/modalbox.css">
    <title>PockeyMoney | Dashboard</title>
</head>
<body>
 <?php include("AD_navbar.php"); 
  //delete feedback
  if (isset($_POST['delete_submit'])) {
    $params['tableName'] = 'feedback';
    $params['idName'] = 'feedbackID';
    $params['id'] = $_POST['delete_feedbackID'];
    $result = $admin->adminDelete($params);
    if ($result['status'] == 'ok') {
        $admin->showAlert($result['statusMsg']);
    } else {
        $admin->showAlert($result['statusMsg']);
    }
    $admin->goTo('admin_feedback.php?role=admin');
}

 ?>
    <div class="container-fluid background">
      <div class="container-fluid">
          <div class="container-fluid body feedback">
              <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">FEEDBACK STUDIO</a>
                  </nav>

                <!--Delete Modal-->
                <div class="modal fade edit-modal" id="delete-row" tabindex="-1" role="dialog" aria-labelledby="delete-title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p>Are you sure want to Delete this Feedback?</p>
                            </div>
                            <div class="modal-footer">
                                <form action="" method="POST">
                                    <input type="hidden" id="delete_feedbackID" name="delete_feedbackID"></input>
                                    <button type="submit" class="btn btn-primary" name="delete_submit">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                  <table class="table feedback-table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sender Name</th>
                        <th scope="col">Email Address</th>
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
                    <input type="hidden" class="feedbackID" value='<?php echo ($query[$i]['feedbackID']); ?>'></input>
                    <th scope = "row"><?php echo ($i +1 ); ?></th>
                    <td class="feedback_customer"><?php echo ($query[$i]['contact_name']); ?></td>
                    <td class="feedback_email"><?php echo ($query[$i])['contact_email']; ?></td>
                    <td class="feedback_content"><?php echo ($query[$i]['content']); ?></td>
                    <td class="action">
                                      <a href="#" class="delete-feedback-anchor" data-toggle="modal" data-target="#delete-row">Delete</a>
                                  </td>
                    </tr> 
                    <?php }
                   } ?>

                    </tbody>
                  </table>
                    <br><br>
                    <a href="https://mail.google.com/" class="btn btn-outline-primary reply-feedback">Reply</a>
                    <br>
                </div>
                <script src="./script/feedback.js"></script>

</html>
