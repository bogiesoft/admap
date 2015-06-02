<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\user\User;

/* @var $this yii\web\View */
/* @var $updateInformation backend\models\user\UpdateInformationForm */
/* @var $updatePassword backend\models\user\UpdatePasswordForm */

$this->title = Yii::t('app', 'Update information {username}', [
    'username' => Html::encode($updateInformation->username)
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Users Manager'),
    'url' => ['/user/index']
];
$this->params['breadcrumbs'][] = Html::encode($updateInformation->username);

$js ="
$('form#{$updateInformation->formName()}').on('beforeSubmit', function(e, \$form) {
    ajaxLoadHtml('{$updateInformation->formName()}', 'update-container');
    reloadPjax('userList-pjax');
    return false;
}).on('submit', function(e){
    e.preventDefault();
});
";
$this->registerJs($js);

$js ="
$('form#{$updatePassword->formName()}').on('beforeSubmit', function(e, \$form) {
    return ajaxLoadHtml('{$updatePassword->formName()}', 'update-container');
}).on('submit', function(e){
    e.preventDefault();
});
";
$this->registerJs($js);

?>
<div id="update-container" class="max-width-500">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Yii::t('app', 'Update information') ?></h3>
                </div>
                <div class="panel-body">
                    <?php if ($updateInformation->informationUpdated): ?>
                    <div class="alert alert-success"><?= Yii::t('app', 'Information successfully updated.') ?></div>
                    <?php endif; ?>
                    <?php
                    $form = ActiveForm::begin([
                                'id' => $updateInformation->formName(),
                                //'enableAjaxValidation' => true,
                                //'validateOnSubmit' => true,
                                //'validateOnChange' => false,
                                //'validateOnBlur' => false,
                                'enableClientValidation' => true,
                                //'validationUrl' => ['/user/ajax-register-validation'],
                    ]);
                    ?>
                    <?= Html::activeHiddenInput($updateInformation, 'id') ?>
                    <?= $form->field($updateInformation, 'username')->textInput(['dir' => 'ltr']) ?>
                    <?= $form->field($updateInformation, 'email')->textInput(['dir' => 'ltr']) ?>
                    <?php
					if (Yii::$app->getUser()->can('UserDisable')){
						echo $form->field($updateInformation, 'status')->dropDownList(User::getStatusList());
					}
					?>
                    <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary btn-block']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Yii::t('app', 'Update password') ?></h3>
                </div>
                <div class="panel-body">
                    <?php if ($updatePassword->passwordUpdated): ?>
                    <div class="alert alert-success"><?= Yii::t('app', 'Password successfully updated.') ?></div>
                    <?php endif; ?>
                    <?php
                    $form = ActiveForm::begin([
                                'id' => $updatePassword->formName(),
                                //'enableAjaxValidation' => true,
                                //'validateOnSubmit' => true,
                                //'validateOnChange' => false,
                                //'validateOnBlur' => false,
                                'enableClientValidation' => true,
                                //'validationUrl' => ['/user/ajax-register-validation'],
                    ]);
                    ?>
                    <?= Html::activeHiddenInput($updatePassword, 'id') ?>
                    <?= $form->field($updatePassword, 'password')->passwordInput(['dir' => 'ltr']) ?>
                    <?= $form->field($updatePassword, 'confirmPassword')->passwordInput(['dir' => 'ltr']) ?>
                    <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary btn-block']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>