<?php
if (!Configure::read('debug')):
	throw new NotFoundException();
endif;
$this->assign('title','Seleccionar Relleno/s');
App::uses('Debugger', 'Utility');

//include_once('home-default.ctp');
                    /*echo $this->Html->link(
                            $this->Html->image("img/1.png", ["class" => "ui-li-thumb"]),
                            ['controller' => 'cakebases', 'action' => 'index']);*/
?>
<div id="demo-page" class="my-page">
    <div role="main" class="ui-content">
        <ul data-role="listview" data-inset="true">
            <?php foreach ($fillings as $filling): ?>
                <li> 
                    <input id="SelectedSensors_1__Value" name="SelectedSensors[1].Value" type="checkbox" 
                           value="false" onclick="storeData ('baseid', '<?php echo $filling['Filling']['fillingid']; ?>')"/>            
                        <img src="<?php echo $filling['Filling']['image']; ?>" class="ui-li-thumb"> 
                        <h2><?php echo $filling['Filling']['name']; ?></h2>
                        <p><?php echo $filling['Filling']['description']; ?></p>
                        <p class="ui-li-aside"><?php echo $filling['Filling']['price']." €"; ?></p>
                    </a>
                </li>
            <?php endforeach; ?>
            <?php unset($filling) ?>
        </ul>
    </div><!-- /content -->
</div>
<div class="ui-grid-c ui-responsive">
    <div class="ui-block-a"><a href="#" class="ui-btn ui-shadow ui-corner-all">Base</a></div>
    <div class="ui-block-b"><a href="#" class="ui-btn ui-shadow ui-corner-all ui-state-disabled">Relleno</a></div>
    <div class="ui-block-c"><a href="#" class="ui-btn ui-shadow ui-corner-all ui-state-disabled">Cobertura</a></div>
    <div class="ui-block-d"><a href="#" class="ui-btn ui-shadow ui-corner-all ui-state-disabled">Procesar</a></div>
</div>