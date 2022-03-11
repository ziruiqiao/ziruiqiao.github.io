<?php
function getColor($star) {
    if ($star == 5) {
        $color = "#ffd700";
    } else if ($star == 4) {
        $color = "#7400a1";
    } else if ($star == 3) {
        $color = "#4169e1";
    } else if ($star == 2) {
        $color = "#90ee90";
    } else {
        $color = "d3d3d3";
    }
    return $color;
}
function searchArtifacts($ret) {
    $specialArtifactList = array(101, 102, 103, 104, 272, 273, 274, 275);
    $twoArtifact = array(170, 171);
    $counter = 0;
    $num = 0;
    $count = 0;
    while($row = $ret->fetchArray() ){
        $set= $row['set_name'];
        $part = $row['part'];
        $img = $row['aImage'];
        $star = $row['star_rating'];
        $a_id = $row['a_id'];
        if ($count == 0) {
            echo "<h3>Artifacts: </h3><ul>";
            $count = 1;
        }
        if($counter == 0) {
            echo "<li>";
            echo "<form action='searchedArtifact.php' method='post'>
        <input type='submit' name='submit' value=\"".$set."\">
        <input type='hidden' name='set' value=\"".$set."\">
        <input type='hidden' name='star' value=\"".$star."\">
        </form><br/>\n";
        }
        if(!in_array($a_id, $specialArtifactList, TRUE)) {
            $counter += 1;
        }
        echo "<div class='box" . $num . "'><img src=" . $img . " width=70 height=70/></div>>";
        echo "<style type='text/css'>
    .box" . $num . " {
            width: 70px;
            background-color: " . getColor($star) . ";
        } 
    </style>";
        echo $part;
        $num += 1;
        if (($counter == 5) || (in_array($a_id, $twoArtifact, TRUE) && $counter == 2)) {
            $counter = 0;
            echo "</li>";
        }
    }
    if ($count == 1) {
        echo "</ul>";
    }
}
function searchBosses($ret) {
    $counter = 0;
    while ($row = $ret->fetchArray()) {
        if ($counter == 0) {
            echo "<h4>Boss:</h4><ul>";
            $counter = 1;
        }
        $name = $row['b_name'];
        $img = $row['bImage'];
        echo "<li><img src=" . $img . " width=100 height=100/>";
        echo "<form action='searchedBoss.php' method='post'>
                    <input type='submit' name='submit' value=\"" . $name . "\">
                    <input type='hidden' name='b_name' value=\"" . $name . "\">
                  </form><br/>\n";
        echo "</li>";
    }
    if ($counter == 1) {
        echo "</ul>";
    }
}
function searchCharacters($ret) {
    echo "<ul>";
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $c_name = $row['c_name'];
        $c_img = $row['cImage'];

        echo "<li>";
        echo "<img src=".$c_img." width=100 height=100/>";
        echo "<form action='searchedCharacter.php' method='post'>
            <input type='submit' name='submit' value=\"".$c_name."\">
            <input type='hidden' name='c_name' value=\"".$c_name."\">
          </form><br/>\n";
        echo "</li>";
    }
    echo "</ul>";
}
function searchDomains($ret, $fromTalent) {
    $counter = 0;
    $count = 0;
    while ($row = $ret->fetchArray()) {
        if ($count == 0) {
            echo "<h4>Domain:</h4><ul>";
            $count = 1;
        }
        $name = $row['domain'];
        if($fromTalent) {
            $D_day = $row['day'];
        }
        if($counter == 0) {
            if(!$fromTalent) {
                echo "<li>";
            }
            echo "<form action='searchedDomain.php' method='post'>
                            <input type='submit' name='submit' value=\"" . $name . "\">
                            <input type='hidden' name='D_name' value=\"" . $name . "\">
                            </form><br/>\n";
            if(!$fromTalent) {
                echo "</li>";
            } else {
                $counter += 1;
            }
        }
        if($fromTalent) {
            echo "<li>";
            echo "<p>" . $D_day . "</p>";
            echo "</li>";
        }
    }
    if ($count == 1) {
        echo "</ul>";
    }
}
function searchDrops($ret) {
    $counter = 0;
    while($row = $ret->fetchArray() ){
        if ($counter == 0) {
            echo "<h3>Drops: </h3><ul>";
            $counter = 1;
        }
        $d_name = $row['d_name'];
        $d_img = $row['dImage'];
        echo "<li>";
        echo "<img src=".$d_img ." width=100 height=100/>";
        echo "<form action='searchedDrop.php' method='post'>
            <input type='submit' name='submit' value=\"".$d_name."\">
            <input type='hidden' name='d_name' value=\"".$d_name."\">
          </form><br/>\n";
        echo "</li>";
    }
    if ($counter == 1) {
        echo "</ul>";
    }
}
function searchTalents($ret, $fromList) {
    $counter = 0;
    $count = 0;
    while($row = $ret->fetchArray() ) {
        if ($count == 0) {
            echo "<h3>Talent Level UP Materials: </h3><ul>";
            $count = 1;
        }
        $name = $row['t_name'];
        $img = $row['tImage'];
        if (!$fromList) {
            $day = $row['day'];
        }
        if ($counter == 0) {
            echo "<li><img src=" . $img . " width=100 height=100/>";
            echo "<form action='searchedTalent.php' method='post'>
            <input type='submit' name='submit' value=\"" . $name . "\">
            <input type='hidden' name='t_name' value=\"" . $name . "\">
            </form><br/>\n";
            echo "</li>";
        }
        if (!$fromList) {
            if ($counter == 0){
                echo "<ul>";
            }
            $counter += 1;
            echo "<li>";
            echo $day;
            echo "</li>";
        }
        if ($counter == 3) {
            $counter = 0;
            echo "</ul></li>";
        }
    }
    if ($count == 1) {
        echo "</ul>";
    }
}
