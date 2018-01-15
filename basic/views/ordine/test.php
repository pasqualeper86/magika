<?php 
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use app\models\Cliente;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;

$colorPluginOptions =  [
    'showPalette' => true,
    'showPaletteOnly' => true,
    'showSelectionPalette' => true,
    'showAlpha' => false,
    'allowEmpty' => false,
    'preferredFormat' => 'name',
    'palette' => [
        [
            "white", "black", "grey", "silver", "gold", "brown", 
        ],
        [
            "red", "orange", "yellow", "indigo", "maroon", "pink"
        ],
        [
            "blue", "green", "violet", "cyan", "magenta", "purple", 
        ],
    ]
];
$gridColumns = [
    [
        'class' => 'kartik\grid\SerialColumn',
        'contentOptions' => ['class' => 'kartik-sheet-style'],
        'width' => '36px',
        'header' => '',
        'headerOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\RadioColumn',
        'width' => '36px',
        'headerOptions' => ['class' => 'kartik-sheet-style'],
    ],
    [
        'class' => 'kartik\grid\ExpandRowColumn',
        'width' => '50px',
        'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        'detail' => 'www.google.com',
        'headerOptions' => ['class' => 'kartik-sheet-style'],
        'expandOneOnly' => true
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'commento',
        'pageSummary' => 'ads',
        'vAlign' => 'middle',
        'width' => '210px',
        /*'readonly' => function($model, $key, $index, $widget) {
            return (!$model->status); // do not allow editing of inactive records
        },*/
        'editableOptions' =>  function ($model, $key, $index) use ($colorPluginOptions) {
            return [
                'header' => 'Commento', 
                'size' => 'md',
                
            ];
        }
    ],
    [
        'attribute' => 'cliente', 
        'vAlign' => 'middle',
        'width' => '180px',
        'value' => function ($model, $key, $index, $widget) { 
            return Html::a($model->cliente,  
                '#', 
                ['title' => 'View author detail', 'onclick' => 'alert("This will open the author page.\n\nDisabled for this demo!")']);
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Cliente::find()->orderBy('nome')->asArray()->all(), 'id', 'nome'), 
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Any author'],
        'format' => 'raw'
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'data',    
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'width' => '9%',
        'format' => 'date',
        'xlFormat' => "mmm\\-dd\\, \\-yyyy",
        'headerOptions' => ['class' => 'kv-sticky-column'],
        'contentOptions' => ['class' => 'kv-sticky-column'],
        /*'readonly' => function($model, $key, $index, $widget) {
            return (!$model->status); // do not allow editing of inactive records
        },*/
        'editableOptions' => [
            'header' => 'Data', 
            'size' => 'md',
            'inputType' => \kartik\editable\Editable::INPUT_DATE,
            'widgetClass' =>  'kartik\datecontrol\DateControl',
            'options' => [
                /*'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'displayFormat' => 'dd.MM.yyyy',*/
                //'saveFormat' => 'php:Y-m-d',
                'options' => [
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ]
            ]
        ],
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'importo', 
        /*'readonly' => function($model, $key, $index, $widget) {
            return (!$model->status); // do not allow editing of inactive records
        },*/
        'editableOptions' => [
            'header' => 'Importo', 
            'inputType' => \kartik\editable\Editable::INPUT_SPIN,
            'options' => [
                'pluginOptions' => ['min' => 0, 'max' => 5000]
            ]
        ],
        'hAlign' => 'right', 
        'vAlign' => 'middle',
        'width' => '7%',
        'format' => ['decimal', 2],
        'pageSummary' => true
    ],
    [
        'attribute' => 'importo_netto', 
        'vAlign' => 'middle',
        'hAlign' => 'right', 
        'width' => '7%',
        'format' => ['decimal', 2],
        'pageSummary' => true
    ],
    
    [
        'class' => 'kartik\grid\ActionColumn',
        //'dropdown' => $this->dropdown,
        'dropdownOptions' => ['class' => 'pull-right'],
        'urlCreator' => function($action, $model, $key, $index) { return '#'; },
        'viewOptions' => ['title' => 'This will launch the book details page. Disabled for this demo!', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['title' => 'This will launch the book update page. Disabled for this demo!', 'data-toggle' => 'tooltip'],
        'deleteOptions' => ['title' => 'This will launch the book delete action. Disabled for this demo!', 'data-toggle' => 'tooltip'],
        'headerOptions' => ['class' => 'kartik-sheet-style'],
    ],
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'headerOptions' => ['class' => 'kartik-sheet-style'],
    ],
];

// the GridView widget (you must use kartik\grid\GridView)
echo GridView::widget([
    'id' => 'kv-grid-demo',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
    'pjax' => true, // pjax is set to always true for this demo
    // set your toolbar
    'toolbar' =>  [
        '{export}',
        '{toggleData}',
    ],
    // set export properties
    'export' => [
        'fontAwesome' => true
    ],
    // parameters from the demo form
    'bordered' => true,
    'striped' => false,
    'condensed' => true,
    'responsive' => true,
    'hover' => true,
    'showPageSummary' => true,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        
    ],
    'persistResize' => false,
    'toggleDataOptions' => ['minCount' => 10],
    //'exportConfig' => $exportConfig,
    'itemLabelSingle' => 'book',
    'itemLabelPlural' => 'books'
]);

?>