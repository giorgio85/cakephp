<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */

if (!Configure::read('debug')):
	throw new NotFoundException();
endif;
$this->assign('title','Seleccionar base');
App::uses('Debugger', 'Utility');

//include_once('home-default.ctp');
                    /*echo $this->Html->link(
                            $this->Html->image("img/1.png", ["class" => "ui-li-thumb"]),
                            ['controller' => 'cakebases', 'action' => 'index']);*/
$baseid = 0;
if (isset($this->request->pass[0])){
    $baseid = $this->request->pass[0];
}
$fillingid = 0;
if (isset($this->request->pass[1])){
    $fillingid = $this->request->pass[1];
}
$coatingid = 0;
if (isset($this->request->pass[2])){
    $coatingid = $this->request->pass[2];
}
?>
<div id="demo-page" class="my-page">
    <div role="main" class="ui-content">
        <ul data-role="listview" data-inset="true">
            <?php foreach ($bases as $base): ?>
                <li>
                    <a href="/cakephp/fillings/select/<?php echo $base['CakeBase']['id']."/".$fillingid."/".$coatingid; ?>" onclick="storeData ('baseid', '<?php echo $base['CakeBase']['id']; ?>')">
                        <img src="<?php echo $base['CakeBase']['image']; ?>" class="ui-li-thumb">
                        <h2><?php echo $base['CakeBase']['name']; ?></h2>
                        <p><?php echo $base['CakeBase']['description']; ?></p>
                        <p class="ui-li-aside"><?php echo $base['CakeBase']['price']." €"; ?></p>
                    </a>
                </li>
            <?php endforeach; ?>
            <?php unset($base) ?>
        </ul>
    </div><!-- /content -->
</div>
<div class="ui-grid-b">
    <!--?php if ($baseid!=0): ?>
        <div class="ui-block-a"><a href="/cakephp/cakebases/select/<!--?php echo $baseid."/".$fillingid."/".$coatingid; ?>" class="ui-btn ui-shadow ui-corner-all">Base</a></div>
    <!--?php else:?
            <div class="ui-block-a"><a href="#" class="ui-btn ui-shadow ui-corner-all ui-state-disabled">Base</a></div>
    <!--?php endif;?-->
    <?php if ($fillingid!=0): ?>
        <div class="ui-block-a"><a href="/cakephp/fillings/select/<?php echo $baseid."/".$fillingid."/".$coatingid; ?>" class="ui-btn ui-shadow ui-corner-all">Relleno</a></div>
    <?php else:?>
            <div class="ui-block-a"><a href="#" class="ui-btn ui-shadow ui-corner-all ui-state-disabled">Rellenos</a></div><?php endif;?>
    <?php if ($coatingid!=0): ?>
        <div class="ui-block-b"><a href="/cakephp/coatings/select/<?php echo $baseid."/".$fillingid."/".$coatingid; ?>" class="ui-btn ui-shadow ui-corner-all">Cobertura</a></div>
        <div class="ui-block-c"><a href="/cakephp/orders/process/<?php echo $baseid."/".$fillingid."/".$coatingid; ?>" class="ui-btn ui-shadow ui-corner-all">Procesar</a></div>
    <?php else:?>
            <div class="ui-block-b"><a href="#" class="ui-btn ui-shadow ui-corner-all ui-state-disabled">Cobertura</a></div>
            <div class="ui-block-c"><a href="#" class="ui-btn ui-shadow ui-corner-all ui-state-disabled">Procesar</a></div>
    <?php endif;?>
</div>