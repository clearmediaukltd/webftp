<script type="text/javascript" src="<?=base_url();?>js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php"></script>
<script type="text/javascript">
<!--//
	tinyMCE.init({
		mode: "textareas",
		theme: "advanced",
		skin : "o2k7",
		plugins: "media, save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,searchreplace,print,paste,directionality,fullscreen,noneditable,contextmenu,paste",
		theme_advanced_buttons1: "bold,italic,underline,|,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink,anchor,image,",
		theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,cleanup,code,|,search,replace,|,media",
		theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location: "top",
		theme_advanced_toolbar_align: "left",
		theme_advanced_statusbar_location: "bottom",
		file_browser_callback: "tinyBrowser",
		theme_advanced_resizing: true,
		relative_urls: false,
		document_base_url: "<?=base_url();?>"
	});
//-->
</script>