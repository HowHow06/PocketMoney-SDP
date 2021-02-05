<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include(".head.php"); ?>
    <link rel="stylesheet" href="./style/profile.css">

    <title>PocketMoney | Announcements</title>
</head>
<body>
    <?php    
        $activePage = "settings";
        include(".navbar.php");
    ?>
    <div class="container-fluid background">
        <div class="container-fluid body" style="min-height: 80vh; max-width: 1000px">
            <nav class="navbar navbar-expand-lg">
                <a href="#" class="navbar-brand">ANNOUNCEMENTS</a>
            </nav>
            <div class="container-fluid">
                <?php
                    $datarow = $customer->getDataByQuery("SELECT * FROM announcement ORDER BY announcement_date DESC");
                    if (!empty($datarow)){
                        foreach($datarow as $row => $data) {
                ?>

                <div class="announcement-section">
                    <input type="hidden" name="announcementID" id="announcmentID" value="<?php echo ($data['announcementID']); ?>">
                    <h4><?php echo ($data['title']); ?></h4>
                    <p style="color: grey"><i>Posted on: <?php echo ($data['announcement_date']); ?></i></p>
                    <h6 style="line-height: 24px"><?php echo ($data['content']); ?></h6>
                    <hr>
                </div>

                <?php
                        }
                    }
                ?>
                <p class="text-center" style="font-size: 10px; color: grey;">End of announcement</p>
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
</html>