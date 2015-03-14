<h1>Edit Post</h1>
<?php
    echo $this->Form->create('Post', ['action' => 'edit', 'data-ajax'=>'false']);
    echo $this->Form->input('title');
    echo $this->Form->input('body', array('rows' => '3'));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('Guardar');