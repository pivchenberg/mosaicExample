<?php
/**
 * Created by PhpStorm.
 * User: Ксенич
 * Date: 18.06.2017
 * Time: 18:50
 */

require 'vendor/autoload.php';

use Pivchenberg\MosaicBlocks\Mosaic\MosaicElement;
use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeFullHorizontalFullVertical;
use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeQuarterHorizontalFullVertical;
use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeHalfHorizontalHalfVertical;
use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeHalfHorizontalFullVertical;
use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeThreeQuarterHorizontalFullVertical;
use Pivchenberg\MosaicBlocks\Mosaic\Mosaic;


$mosaicElements = [
    new MosaicElement(new MosaicTypeFullHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeHalfHorizontalHalfVertical()),
    new MosaicElement(new MosaicTypeQuarterHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeHalfHorizontalHalfVertical()),
    new MosaicElement(new MosaicTypeQuarterHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeQuarterHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeQuarterHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeQuarterHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeThreeQuarterHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeHalfHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeThreeQuarterHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeQuarterHorizontalFullVertical()),
];

$mosaic = new Mosaic($mosaicElements);
$mosaic->prepareOutput();

?>
    <div style="position: absolute; top: 10px; left: 10px;">
        <ul style="list-style-type: none;">
            <?php
            /** @var MosaicElement $rme */
            foreach ($mosaicElements as $rme):?>
                <li><?php echo $rme->getId() ?>. <?php echo $rme->getMosaicType()->getShortName() ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div style="width: 600px; margin: 0 auto;">
        <div>
            <?php
            foreach ($mosaic->getResultMosaic() as $k => $mosaicRow) {
                ?>
                <div style="vertical-align: top; <?php echo $mosaicRow->isRowFilledCorrectly() ? 'outline: 2px solid green;' : 'outline: 2px solid red;'; ?>">
                    <?php
                    foreach ($mosaicRow->getMosaicElements() as $mosaicElement) {
                        if (is_array($mosaicElement)) {
                            echo '<div style="vertical-align: top; width: 300px; display: inline-block">';
                            foreach ($mosaicElement as $me) {
                                drawElement($me);
                            }
                            echo '</div>';
                        } else {
                            drawElement($mosaicElement);
                        }
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>


<?php
function dump($ar, $title = '')
{

    echo '<pre style="background: black; color: tomato; font-size: 12px; min-height: 10px;">';
    if ($title) {
        echo '<h4 style=" color: #fff">' . $title . '</h4>';
    }
    print_r($ar);
    echo '</pre>';
}

function drawElement($mosaicElement)
{
    $content = "Id: {$mosaicElement->getId()}<br>Type: {$mosaicElement->getMosaicType()->getShortName()}";
    switch ($mosaicElement->getMosaicType()->getShortName()) {
        case '<1h|1v>':
            $el = "<div style='border:1px dashed black; display: inline-block; width: 598px; height: 198px; background: tomato'>{$content}</div>";
            break;
        case '<1/2h|1v>':
            $el = "<div style='border:1px dashed black; display: inline-block; width: 298px; height: 198px; background: limegreen'>{$content}</div>";
            break;
        case '<1/2h|1/2v>':
            $el = "<div style='border:1px dashed black; display: inline-block; width: 298px; height: 98px; background: steelblue'>{$content}</div>";
            break;
        case '<1/4h|1v>':
            $el = "<div style='border:1px dashed black; display: inline-block; width: 148px; height: 198px; background: teal'>{$content}</div>";
            break;
        case '<3/4h|1v>':
            $el = "<div style='border:1px dashed black; display: inline-block; width: 448px; height: 198px; background: violet;'>{$content}</div>";
            break;
    }
    echo $el;
}