<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'arbizshop-create-form',
//	'enableClientValidation'=>false,
        'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="help-block">带<span class="required">*</span> 为必填项。</p>
        
	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->textFieldRow($model,'name',array('class'=>'span3','hint'=>'如：五道口店')); ?>
        <?php echo $form->textFieldRow($model,'service_tel',array('class'=>'span3','hint'=>'如，010-8888888，电话之间用英文逗号,隔开')); ?>
        <?php echo $form->textFieldRow($model,'address',array('class'=>'span10')); ?>
        <?php echo $form->textFieldRow($model,'travel_info',array('class'=>'span10')); ?>
        <?php echo $form->textFieldRow($model,'open_time',array('class'=>'span6','hint'=>'如：周一至周五 09:00-18:00 周末全天')); ?>
        <?php echo $form->textFieldRow($model,'lnglat',array('id'=>'inputlonglat','class'=>'span2','onClick'=>"jQuery.facebox({ajax:'". $this->createUrl('/groupon/ajax/baidumap',array('lnglat'=>$model->lnglat))."'});")); ?>
        <?php // echo $form->textFieldRow($model,'lnglat',array('id'=>'inputlonglat','class'=>'span2','data-toggle'=>"modal",'data-target'=>"#myModal")); ?>
       
        <div class="">
            <div style="float:left;margin-right: 15px;">
                <?php echo $form->dropDownListRow($model,'province_id',  ARArea::getAreas(),array(
                'class'=>'span2',
                'prompt'=>'请选择',
                'ajax' => array(
                    'type'=>'POST',
                    'url'=>$this->createUrl('ajax/subarea'),
    //                'update'=>'#ARBizShop_city_id',
                    'success'=>'function(data){
                        $("#ARBizShop_city_id").html(data);
                        $("#ARBizShop_area_id").html("<option value=\"\">请选择</option>");
                        }',
                    'data'=>array(Yii::app()->request->csrfTokenName=>Yii::app()->request->getCsrfToken(),'pid'=>'js:$("#ARBizShop_province_id").val()','grade'=>  ARArea::GRADE_CITY)
                  )
                ));?>
            </div>
            <div style="float:left;margin-right: 15px;">
                <?php echo $form->dropDownListRow($model,'city_id',  $model->province_id?ARArea::getAreas($model->province_id,  ARArea::GRADE_CITY):array(),array(
                    'class'=>'span2',
                    'prompt'=>'请选择',
                    'ajax' => array(
                        'type'=>'POST',
                        'url'=>$this->createUrl('ajax/subarea'),
                        'update'=>'#ARBizShop_area_id',
                        'data'=>array(Yii::app()->request->csrfTokenName=>Yii::app()->request->getCsrfToken(),'pid'=>'js:$("#ARBizShop_city_id").val()','grade'=>  ARArea::GRADE_AREA)
                      )
                    ));?>
            </div>
           
            <?php echo $form->dropDownListRow($model,'area_id',  $model->city_id?ARArea::getAreas($model->city_id,  ARArea::GRADE_AREA):array(),array('class'=>'span2','prompt'=>'请选择'));?>
            <?php // echo $form->dropDownListRow($model,'cbd_id',  $model->province_id?ARArea::getAreas($model->province_id,  ARArea::GRADE_CITY):array(),array('class'=>'span2','prompt'=>'请选择'));?>

        </div>
        <?php echo $form->checkBoxRow($model,'is_reservation',array('uncheckValue'=>0,'hint'=>'勾选表示需要预约'));?>
        <?php echo H::hiddenField('return_url', Yii::app()->request->urlReferrer)?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? '创建' : '保存',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->