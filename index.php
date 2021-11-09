<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset="UTF-8">
        <title>写真ギャラリー</title>
        <link href="index.css" rel="stylesheet" type="text/css">

        <script type="text/javascript" src="./jquery.js"></script>
        <script type="text/javascript" src="./index.js"></script>

    </head>
    <body>
        <?php

            $folderPath = './images/';
            $directory = scandir($folderPath);
            $img_array = array();
            $fullPath_array = array();
            foreach ($directory as $fileName) {
                $fullPath = $folderPath.$fileName;
                if(is_file($fullPath) == true){
                    $mimeTepe = mime_content_type($fullPath);
                    if($mimeTepe == 'image/jpeg' || $mimeTepe == 'image/gif' || $mimeTepe == 'image/png' || $mimeTepe == 'image/pjpeg' || $mimeTepe == 'image/x-png'){
                        list($width, $height) = getimagesize($fullPath);
                        if ($width > $height) {
                            $new_width = '180px';
                            $new_height = 'auto';
                        }
                        else {
                            $new_width = 'auto';
                            $new_height = '180px';
                        }
                        $img = "<img src=\"{$fullPath}\" width=\"{$new_width}\" height=\"{$new_height}\"/>";
                        array_push($img_array,$img);
                        array_push($fullPath_array,$fullPath);
                    }
                }
            }

            define('MAX','6');
            $img_num = count($img_array);
            $max_page = ceil($img_num / MAX);

            if(!isset($_GET['page'])){ 
                $now = 1;
            }else{
                $now = $_GET['page'];
            }

            $start_no = ($now - 1) * MAX;
            $image_data = array_slice($img_array, $start_no, MAX);
            $fullPath_data = array_slice($fullPath_array, $start_no, MAX);

            $fullPath_data_json = json_encode($fullPath_data);
        ?>

        <script type="text/javascript">
        let $fullPath_js_data = <?php echo $fullPath_data_json; ?>;
        </script>
        <header>
            <h1>写真ギャラリー<h1>
        </header>
        <main>
            <?php
                for ($i=0; $i < count($image_data); $i++) {
                    print(
                        "<div class = \"image-box\"><a class = \"image\" href=\"#\" name=\"image".$i."\">".$image_data[$i]."</a></div>"
                    );
                }
            ?>

        </main>
        <footer>
            <?php
                
                if ($now != 1) {
                    print('<a href="./index.php?page=1">«　first</a>  ');
                }
                

                for($i = 1; $i <= $max_page; $i++){ 
                    if ($i == $now) {
                        print($now.' '); 
                    } 
                else {
                    $page = "./index.php?page=". $i;
                    $a = "<a href=". $page .">";
                    print($a.$i.'</a> ');
                    }
                }

                if ($now != 5) {
                    print($a.'last »</a>');
                }

                
            ?>
        </footer>
        <div class = "popup">
            <img class = "popup_img">
        </div> 
    </body>
</html>

