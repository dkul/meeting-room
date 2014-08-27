<?php
/** @var \MeetingRoom\Entity\PC $pc */
$pc = $this->result;
?>
<div>
    <h1><?php echo $this->title; ?></h1>
    <?php
    if($pc)
    {
        echo 'Title: ' . $pc->getTitle();
        echo '<br/>';
        echo 'Is camera: ' . $pc->getIsCamera();
        echo '<br/>';
        echo 'Is internet: ' . $pc->getIsInternet();
        echo '<br/>';
    }
    ?>
</div>
<div>
    <?php
    if($this->error){
        echo $this->error;
    }
    ?>
</div>