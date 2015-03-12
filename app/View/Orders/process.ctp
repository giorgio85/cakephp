<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */
echo $this->Html->css('recetas');
if (!Configure::read('debug')):
	throw new NotFoundException();
endif;
$this->assign('title','Procesar pedido');
App::uses('Debugger', 'Utility');

//include_once('home-default.ctp');
                    /*echo $this->Html->link(
                            $this->Html->image("img/1.png", ["class" => "ui-li-thumb"]),
                            ['controller' => 'cakebases', 'action' => 'index']);*/
?>
<div class="ui-grid-b ui-responsive">
    <div class="ui-block-a"><a href="#" class="ui-btn ui-shadow ui-corner-all">Base</a></div>
    <div class="ui-block-b"><a href="#" class="ui-btn ui-shadow ui-corner-all">Relleno</a></div>
    <div class="ui-block-c"><a href="#" class="ui-btn ui-shadow ui-corner-all">Cobertura</a></div>
</div>
<?php
    echo "<h3><center>Receta de ".$base['CakeBase']['name']." con ";
    echo $filling['Filling']['name']." y ";
    echo $coating['Coating']['name']."</h3></center>";
    echo $base['CakeBase']['recipe'];
    echo $filling['Filling']['recipe'];
    echo $coating['Coating']['recipe'];
?>