<div>
    <?php echo $this->parseShortcodesString($this->getTemplateContent()); ?>
    <div data-type="files">
        <?php
            _print_styles();
            print_head_scripts();
            print_late_styles();
            print_footer_scripts();
        ?>
    </div>
</div><script><?php echo json_encode($this->post_shortcodes) ?></script>
