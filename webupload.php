<?php
    if ($_SESSION["logged"] == 0){
        header("location: index.php");
    }
    require_once 'db/connect.php';
    $x;
    $y;
    $pos1;
    $pos2;
    $height;
    $width;
    try
    {
    $conn->query("USE camagru");
    $stmt = $conn->prepare("SELECT * FROM `gallery` ORDER BY `img_id` DESC LIMIT 1");
    $stmt->execute();
    $num = $stmt->fetch();
    $newimgID = $num["img_id"] + 1 ;
    //echo $newimgID;
    }
    catch (PDOException $e) 
    {
    print "Error : ".$e->getMessage()."<br/>";
    die();
    }

    $user_id = $_SESSION["id"];
    $data = explode( ',', $_POST["img64"] );
    $test = base64_decode($data[1]);
    //echo $user_id;
    //var_dump($_POST);
    
    file_put_contents("images/gallery/user_".$user_id."_image_".$newimgID.".png", $test);
    $dest= imagecreatefrompng("images/gallery/user_".$user_id."_image_".$newimgID.".png");
    if(!empty($_POST["emoji64"]))
    {
        $emo = explode ('Camagru/',$_POST["emoji64"]);   
        $src = imagecreatefrompng($emo[1]);
        $width = ImageSx($src);
        $height = ImageSy($src);
        pic_position($emo);
        ImageCopyResampled($dest,$src,$pos2,$pos1,0,0,$x,$y,$width,$height);
    }
    
    if(!empty($_POST["emoji64_2"]))
    {
        $emo2 = explode ('Camagru/',$_POST["emoji64_2"]);
        $src = imagecreatefrompng($emo2[1]);
        $width = ImageSx($src);
        $height = ImageSy($src);
        pic_position($emo2);
        ImageCopyResampled($dest,$src,$pos2,$pos1,0,0,$x,$y,$width,$height);
    }
    
    imagepng($dest, "images/gallery/user_".$user_id."_image_".$newimgID.".png");

    try{
        $conn->query("USE camagru");
        $stmt = $conn->prepare("INSERT INTO `gallery` (`id`, `filename`) VALUES (:user, :img)");
        $stmt->bindValue(':user', $user_id);
        $stmt->bindValue(':img', "user_".$user_id."_image_".$newimgID.".png");
        $stmt->execute();
        $likes = $conn->prepare("INSERT INTO `likes` (`likes`) VALUES (:likes)");
        $amm = 0;
        $likes->bindvalue(':likes', $amm);
        $likes->execute();
    }
    catch (PDOException $e) 
    {
        print "Error : ".$e->getMessage()."<br/>";
        die();
    }
    header("location: newpic.php");
    function pic_position($emo)
    {
        global $x, $y, $width, $height, $pos1, $pos2;
        switch ($emo[1])
        {
            case "images/emojis/emoji1.png" :
                $pos1 = 0;
                $pos2 = 200;
                $x = $width/3.5; $y = $height/3.5;
                break;
            case "images/emojis/emoji2.png" :
                $pos1 = 0;
                $pos2 = 0;
                $x = $width/3.5; $y = $height/3.5;
                break;
            case "images/emojis/emoji3.png" :
                $pos1 = 0;
                $pos2 = 200;
                $x = $width/2.8; $y = $height/2.8;
                break;
            case "images/emojis/emoji4.png" :
                $pos1 = 0;
                $pos2 = 0;
                $x = $width/10; $y = $height/10;
                break;
            case "images/emojis/emoji5.png" :
                $pos1 = 0;
                $pos2 = 200;
                $x = $width/3; $y = $height/3;
                break;
            case "images/emojis/emoji6.png" :
                $pos1 = 0;
                $pos2 = 0;
                $x = $width/3; $y = $height/3;
                break;
            case "images/emojis/emoji7.png" :
                $pos1 = 0;
                $pos2 = 200;
                $x = $width/3; $y = $height/3;
                break;
            case "images/emojis/emoji8.png" :
                $pos1 = 0;
                $pos2 = 0;
                $x = $width/3; $y = $height/3;
                break;
            case "images/emojis/emoji9.png" :
                $pos1 = 0;
                $pos2 = 200;
                $x = $width/5; $y = $height/5;
                break;
            case "images/emojis/emoji10.png" :
                $pos1 = 0;
                $pos2 = 0;
                $x = $width/5; $y = $height/5;
                break;
        }
    }
?>