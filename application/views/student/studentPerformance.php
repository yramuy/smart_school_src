<style>
.progress-label-left
{
    float: left;
    margin-right: 0.5em;
    line-height: 1em;
}
.progress-label-right
{
    float: right;
    margin-left: 0.3em;
    line-height: 1em;
}
.star-light
{
    color:#e9ecef;
}
</style>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>

<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat();?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="box box-primary" id="subject_list">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                                                <div class="row">
                              <form role="form" action="<?php echo site_url('student/search_performance') ?>" method="post" class="class_search_form">
                            <div class="col-md-6">
                                <div class="row">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('class'); ?></label> <small class="req"> *</small>
                                                <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
$count = 0;
foreach ($classlist as $class) {
    ?>
                                                        <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) {
        echo "selected=selected";
    }
    ?>><?php echo $class['class'] ?></option>
                                                        <?php
$count++;
}
?>
                                                </select>
                                                  <span class="text-danger" id="error_class_id"></span>
                                            </div>
                                        </div> 
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('section'); ?></label>
                                                <select  id="section_id" name="section_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="button" name="search" value="search_filter" id="searchBtn" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                </div>
                            </div><!--./col-md-6-->
                               </form>
                                 
                        </div>
                        <div class="table-responsive mailbox-messages"> 
                            <div class="download_label"><?php echo $this->lang->line('subject_group_list'); ?></div>

                            <!-- <a class="btn btn-default btn-xs pull-right" title="<?php echo $this->lang->line('print'); ?>" id="print" onclick="printDiv()" ><i class="fa fa-print"></i></a> 
                            <a class="btn btn-default btn-xs pull-right" title="<?php echo $this->lang->line('export'); ?>"  id="btnExport" onclick="fnExcelReport();"> <i class="fa fa-file-excel-o"></i> </a> -->
                            
                            <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Admission No</th>
                                        <th class="text-left">Student Name</th>
                                        <th>DOB</th>
                                        <th>Gender</th>                                        
                                        <th class="text-right no_print"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="student_body"></tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="ratingmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo "Student Rating"; ?></h4>
            </div>
            <form method="post" id="changepassbtn" action="">
                <div class="modal-body">
                    <div class="form-group row">
                      <div class="col-xs-4">
                        <label for="ex1">Student Name : </label>
                        <input id="student_id" type="hidden">
                        <strong><span id="std_name" class="text-green"></span></strong>
                        
                      </div>
                      <div class="col-xs-4">
                        <label for="ex2">Class : </label>
                        <strong><span id="std_class" class="text-green"></span></strong>
                      </div>                      
                    </div>
                    <div class="form-group row">
                      <div class="col-xs-4">
                        <label for="ex1">Admission No : </label>
                        <strong><span id="std_admisno" class="text-green"></span></strong>
                      </div>
                      <div class="col-xs-4">
                        <label for="ex2">Date Of Birth : </label>
                        <strong><span id="std_dob" class="text-green"></span></strong>
                      </div>
                      <div class="col-xs-3">
                        <label for="ex2">Gender : </label>
                        <strong><span id="std_gender" class="text-green"></span></strong>
                      </div>                      
                    </div>
                    <div class="form-group">
                        <div class="modal-header">                
                            <h4 class="modal-title text-left"><?php echo "Student Skills"; ?></h4>
                        </div>
                        <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Name</th>
                                        <th class="text-center mt-2 mb-4">Rating</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(sizeof($studentskills) > 0){ $i = 1; foreach($studentskills as $stsk){?>
                                        <tr>
                                            <input type="hidden" name="skill_name" id="skill_id" value="<?php echo $stsk['id']; ?>">
                                            <td><?php echo $i; ?></td>                                            
                                            <td><?php echo $stsk['name']; ?></td>
                                            <td>
                                                <h4 class="text-center mt-2 mb-4">
                                                    <?php for($k=1; $k<=5; $k++){?>
                                                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_<?php echo $k; ?>_<?php echo $stsk['id']; ?>" data-rating="<?php echo $k; ?>" onclick="update_rating(<?php echo $stsk['id']; ?>,<?php echo $k; ?>)"></i>                                                   
                                                <?php }?>
                                                </h4>
                                            </td>
                                            
                                        </tr>
                                    <?php $i++; } }?>
                                </tbody>
                            </table>
                    </div>                    
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?php echo $this->lang->line('saving'); ?>"><?php echo $this->lang->line('save'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">

function getSectionByClass(class_id, section_id) {
    if (class_id != "" && section_id != "") {
        $('#section_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {'class_id': class_id},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                    var sel = "";
                    if (section_id == obj.section_id) {
                        sel = "selected";
                    }
                    div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                });
                $('#section_id').append(div_data);
            }
        });
    }
}

$(document).ready(function () {
    var class_id = $('#class_id').val();
    var section_id = '<?php echo set_value('section_id') ?>';
    getSectionByClass(class_id, section_id);
    $(document).on('change', '#class_id', function (e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {'class_id': class_id},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                    div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                });
                $('#section_id').append(div_data);
            }
        });
    });
});
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.star_rating', function () {
            $('#ratingmodal').modal('show');

            var id = $(this).attr("data-id");
            var name = $(this).attr("data-name");
            var section = $(this).attr("data-section");
            var admission = $(this).attr("data-admission");
            var gender = $(this).attr("data-gender");
            var dob = $(this).attr("data-dob");

            $('#student_id').val(id);
            $('#std_name').html(name);
            $('#std_class').html(section);
            $('#std_admisno').html(admission);
            $('#std_dob').html(dob);
            $('#std_gender').html(gender);

            

            // alert(id+' '+name);
        });

    });

 

    function update_rating(skillid,rating){

        for(var count = 1; count <= rating; count++)
        {

            $('#submit_star_'+count+'_'+skillid).removeClass('star-light');

            $('#submit_star_'+count+'_'+skillid).addClass('text-warning');
        }        
        
    }

</script>

<script type="text/javascript">

$(document).ready(function(){

    $(document).on('click', '#searchBtn', function(){

        var classId = $('#class_id').val();
        var sectionId = $('#section_id').val();

        $.ajax({
            type: "POST",
            url: base_url + "student/search_performance",
            data: {'class_id': classId,'sectionId': sectionId},
            dataType: "json",
            success: function (data) {
                $('#student_body').html('');
                var k =1;
                $.each(data, function (i, obj)
                {
                    console.log(obj);
                    $('#student_body').append('<tr><td>'+k+'</td><td>'+obj.admission_no+'</td><td>'+obj.firstname+'</td><td>'+obj.dob+'</td><td>'+obj.gender+'</td><td><a href="#" class="btn btn-default btn-xs star_rating text-green" data-toggle="tooltip" data-placement="bottom" title="<?php echo "Student Rating"; ?>" data-id="'+obj.id+'" data-name="'+obj.firstname+'" data-admission="'+obj.admission_no+'" data-section="'+obj.class+'('+obj.section+')" data-gender="'+obj.gender+'" data-dob="'+obj.dob+'"></i> <i class="fa fa-reorder"></i></a></td></tr>');
                                        k++;
                });
            }
        });

    });

});    
</script>