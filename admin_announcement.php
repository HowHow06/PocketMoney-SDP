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

    //delete transaction
        if (isset($_POST['delete_submit'])) {
            $params['tableName'] = 'announcement';
            $params['idName'] = 'announcementID';
            $params['id'] = $_POST['delete_announcementID'];
            $result = $admin->adminDelete($params);
            if ($result['status'] == 'ok') {
                $admin->showAlert($result['statusMsg']);
            } else {
                $admin->showAlert($result['statusMsg']);
            }
            $admin->goTo('admin_announcement.php');
        }
    ?>

    
    <div class="container-fluid background">
        <div class="container-fluid">
            <div class="container-fluid body announcement">
                <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">ANNOUNCEMENT STATUS</a>
                </nav>
                <div class="modal fade edit-modal" id="delete-row" tabindex="-1" role="dialog" aria-labelledby="delete-title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p>Are you sure want to Delete this Announcement?</p>
                            </div>
                            <div class="modal-footer">
                                <form action="" method="POST">
                                    <input type="hidden" id="delete_announcementID" name="delete_announcementID"></input>
                                    <button type="submit" class="btn btn-primary" name="delete_submit">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Edit Model-->
                <div class="modal fade edit-modal" id="edit-row" tabindex="-1" role="modal" aria-labelledby="edit-title" aria-hidden="true">
                    <div class="AnnouncementModal" role="modal">
                        <div class="modal-content">
                        <span class="close">&times;</span>
                            <div class="modal-body">
                            <label for="title"><b>Title</b></label>
                            <input type="text" placeholder="Title " id="new_title" required>

                            <label for="content"><b>Content</b></label>
                            <input type="text" placeholder="Announcement Content" id="new_content" required>

                            <label for="date"><b>Post Date</b></label>
                            <input type="date" placeholder="Announcement Date" id="new_date" required>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-success" onclick="resetEdit()">Reset</button>
                                <button type="submit" name="edit_submit" class="btn btn-primary">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <table class="table announcement-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Announcement ID</th>
                            <th scope="col">Post Date</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody id ="announcementbody">

                    <?php 
                    
                    $query = $admin->getDataByQuery("SELECT announcementID, adminID, announcement_date, title, content FROM announcement");
                    
                    if (!empty($query)) {
                    for($i = 0; $i < sizeof($query); $i++) {

                      //loop
                    ?> 
                  
                    <tr>
                    <th scope = "row"><?php echo ($i +1 ); ?></th>
                    <td class="ann_date"><?php print_r($query[$i]['announcement_date']); ?></td>
                    <td class="ann_title"><?php echo ($query[$i]['title']); ?></td>
                    <td class="ann_content"><?php echo ($query[$i]['content']); ?></td>
                    <td class="action">
                        <a href="#" class="edit-announcement-anchor" data-toggle="modal" data-target="#edit-row">Edit</a>
                        <span> | </span>
                        <a href="#" class="delete-announcement-anchor" data-toggle="modal" data-target="#delete-row">Delete</a>
                    </td>
                    </tr> 
                    <?php }
                    }?>

                    </tbody>
                </table>
                <br><br>
                <button type="button" id="myBtn" class="btn btn-outline-primary add-announcement">Add new announcement</button>
                <div id="AnnouncementModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <label for="title"><b>Title</b></label>
                        <input type="text" placeholder="Title " id="new_title" required>

                        <label for="content"><b>Content</b></label>
                        <input type="text" placeholder="Announcement Content" id="new_content" required>

                        <label for="date"><b>Post Date</b></label>
                        <input type="date" placeholder="Announcement Date" id="new_date" required>

                        <button type="submit" class="btn">Post Announcement</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
$(document).ready(function () {
    $("body").niceScroll();
    $(".transaction-table").niceScroll();
});
</script>
<script src="./script/announcement.js"></script>
</html>
