<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'a_news_edit').': '.$model->news_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_admin'), 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_news_header'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newsadmin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
<script>

    $("#newsadmin-news_title").change(function () {
        str = $("#newsadmin-news_title").val();
        strChangeLang = str.replace(/ą/g, 'a').replace(/Ą/g, 'A')
            .replace(/ć/g, 'c').replace(/Ć/g, 'C')
            .replace(/ę/g, 'e').replace(/Ę/g, 'E')
            .replace(/ł/g, 'l').replace(/Ł/g, 'L')
            .replace(/ń/g, 'n').replace(/Ń/g, 'N')
            .replace(/ó/g, 'o').replace(/Ó/g, 'O')
            .replace(/ś/g, 's').replace(/Ś/g, 'S')
            .replace(/ż/g, 'z').replace(/Ż/g, 'Z')
            .replace(/ź/g, 'z').replace(/Ź/g, 'Z');
        strReady = strChangeLang.toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');

        $("#newsadmin-news_url").val(strReady);
    }).change();

    CKEDITOR.config.toolbarGroups = [
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
        { name: 'forms', groups: [ 'forms' ] },
        '/',
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ]
        },
        { name: 'links', groups: [ 'links' ] },
        { name: 'insert', groups: [ 'insert' ] },
        '/',
        { name: 'styles', groups: [ 'styles' ] },
        { name: 'colors', groups: [ 'colors' ] },
        { name: 'tools', groups: [ 'tools' ] },
        { name: 'others', groups: [ 'others' ] },
        { name: 'about', groups: [ 'about' ] }
    ];
    CKEDITOR.config.removeButtons = 'Save,NewPage,Preview,Print,Templates';
    CKEDITOR.config.allowedContent = true;
    CKEDITOR.config.entities_latin = false;
    CKEDITOR.replace('newsadmin-news_text');
    CKEDITOR.config.height = 500;
    CKEDITOR.config.skin = 'office2013';

    $('#newsadmin-news_photo_url').change(_ => {
        const input = document.getElementById('newsadmin-news_photo_url');
        if(input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = (e) => {
                $('#current-image').hide();
                const preview = document.getElementById('url_icon-container');
                preview.classList.add('icon-container');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
</script>
