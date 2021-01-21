<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/admin.css">
      <link rel="stylesheet" href="./style/modalbox.css">
    <title>PockeyMoney | Dashboard</title>
</head>
<body>
    <?php include("AD_navbar.php"); ?>
    <div class="container-fluid background">
      <div class="container-fluid">
          <div class="container-fluid body announcement">
              <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">ANNOUNCEMENT STATUS</a>
                  </nav>

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
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>1/1/2021</td>
                        <td>Title 1</td>
                        <td>Haha</td>
                        <td></td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>1/1/2021</td>
                        <td>Title 2</td>
                        <td>Haha</td>
                        <td></td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>1/1/2021</td>
                        <td>Title 3</td>
                        <td>Haha</td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                    <br><br>
                    <button type="button" id="myBtn" class="btn btn-outline-primary add-announcement">Add new announcement</button>
                    <button type="button" class="btn btn-outline-primary editdel-announcement">Edit/Delete</button>
                    <div id="AnnouncementModal" class="modal">
                      <div class="modal-content">
                        <span class="close">&times;</span>
                        <label for="title"><b>Title</b></label>
                        <input type="text" placeholder="Title " name="ann_title" required>

                        <label for="content"><b>Content</b></label>
                        <input type="text" placeholder="Announcement Content" name="ann_content" required>

                        <label for="date"><b>Post Date</b></label>
                        <input type="date" placeholder="Announcement Date" name="ann_date" required>

                        <button type="submit" class="btn">Post Announcement</button>

                      </div>
                      <script src="./script/announcement.js"></script>
                </div>
              </div>
            </div>
          </div>
        </body>


</html>
