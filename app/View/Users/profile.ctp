<?php
$this->assign('title', 'Perfil de usuario');
foreach ($users as $user):
    ?>
    <div id="fotouser" style='float:none;'>

        <img style="border:1px gray solid;" src="/cakephp/img/profile/<?php echo $user['User']['avatar']; ?>"/>
    </div>
    <div id="infouser" style='float:left;'>
        <p> Nombre de usuario: </b><?php echo $this->Session->read('Auth.User.username') ?><br>
            <b>Email: </b><?php echo $this->Session->read('Auth.User.email') ?><br>
            <b>Rol de usuario: </b><?php echo $this->Session->read('Auth.User.role') ?><br>
            <b>Registrado: </b><?php echo $this->Session->read('Auth.User.created') ?><br></p>
   
        <?php echo $this->Form->create('User', ['type' => 'file', 'data-ajax' => 'false']); ?>
        <fieldset>
            <?php
            echo $this->Form->input('avatar', ['type' => 'file', 'label' => 'Actualiza Tu Foto']);
            echo $this->Form->input('userid', ['type' => 'hidden', 'value' => $userid]);
            echo $this->Form->end('Subir imagen');
            ?>
        </fieldset>
    </div>
    <?php
endforeach;
?>