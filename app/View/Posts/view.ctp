<!-- File: /app/View/Posts/view.ctp -->

<h1><?php echo $post['Post']['title']?></h1>

<p><small>Creado: <?php echo $post['Post']['created']?></small></p>

<p><?php echo $post['Post']['body']?></p>

<p><?php echo $this->Html->image($post['Post']['Imagen']); ?></p>
<a href="/PhpProject1">Volver</a>