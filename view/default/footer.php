


<footer data-am-widget="footer" class="am-footer am-footer-default" data-am-footer="{ sn }">
    <div class="am-footer-switch">
        <?php if ($this->config['links']):?>
        友情链接：
        <span class="am-footer-divider"> | </span>
        <?php echo $this->config['links'] ?>
        <?php endif;?>
    </div>

    <div class="am-footer-miscs ">
        <?php if ($this->config['webcopy']):?>
            <?php echo $this->config['webcopy'] ?>
        <?php endif;?>
        <p><?php echo $this->config['icpcode']?></p>
        <p><?php echo $this->config['stacode']?></p>
    </div>
</footer>




</body>

</html>
<?php require_once 'foot.php' ?>