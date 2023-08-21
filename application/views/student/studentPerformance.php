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
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo "Student List"; ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages"> 
                            <div class="download_label"><?php echo $this->lang->line('subject_group_list'); ?></div>

                            <a class="btn btn-default btn-xs pull-right" title="<?php echo $this->lang->line('print'); ?>" id="print" onclick="printDiv()" ><i class="fa fa-print"></i></a> 
                            <a class="btn btn-default btn-xs pull-right" title="<?php echo $this->lang->line('export'); ?>"  id="btnExport" onclick="fnExcelReport();"> <i class="fa fa-file-excel-o"></i> </a>
                            
                            <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Admission No</th>
                                        <th class="text-left">Student Name</th>
                                        <th>Class</th>
                                        <th>DOB</th>
                                        <th>Gender</th>
                                        <th>Admission Date</th>
                                        <th>Grade</th>
                                        <th>Star Rating</th>
                                        <th class="text-right no_print"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(sizeof($students) > 0){ $i = 1; foreach($students as $st){?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><input type="hidden" name="" class=""><?php echo $st['admission_no']; ?></td>
                                            <td><?php echo $st['firstname']; ?></td>
                                            <td><?php echo $st['class'].'('.$st['section'].')' ?></td>
                                            <td><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($st['dob'])); ?></td>
                                            <td><?php echo $st['gender']; ?></td>
                                            <td><?php echo $st['admission_date']; ?></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <a href="#" class="btn btn-default btn-xs star_rating text-green" data-toggle="tooltip" data-placement="bottom" title="<?php echo "Student Rating"; ?>" data-id="<?php echo $st['id'];?>" data-name="<?php echo $st['firstname'];?>" data-admission="<?php echo $st['admission_no'];?>" data-section="<?php echo $st['class'].'('.$st['section'].')' ?>" data-gender="<?php echo $st['gender']; ?>" data-dob="<?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($st['dob'])); ?>"></i> <i class="fa fa-reorder"></i></a>
                                            </td>
                                        </tr>
                                    <?php $i++; } }?>
                                </tbody>
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

    var rating_data = 0;

    //     $(document).on('mouseenter', '.submit_star', function(){

    //     var rating = $(this).data('rating');

    //     reset_background();

    //     for(var count = 1; count <= rating; count++)
    //     {

    //         $('#submit_star_'+count).addClass('text-warning');

    //     }

    // });

    // function reset_background()
    // {
    //     for(var count = 1; count <= 5; count++)
    //     {

    //         $('#submit_star_'+count).addClass('star-light');

    //         $('#submit_star_'+count).removeClass('text-warning');

    //     }
    // }

    // $(document).on('mouseleave', '.submit_star', function(){

    //     reset_background();

    //     for(var count = 1; count <= rating_data; count++)
    //     {

    //         $('#submit_star_'+count).removeClass('star-light');

    //         $('#submit_star_'+count).addClass('text-warning');
    //     }

    // });

    function update_rating(skillid,rating){

        for(var count = 1; count <= rating; count++)
        {

            $('#submit_star_'+count+'_'+skillid).removeClass('star-light');

            $('#submit_star_'+count+'_'+skillid).addClass('text-warning');
        }

        // alert(skillid+' - '+rating);
        
        
    }

    // $(document).on('click', '.submit_star', function(){

    //     rating_data = $(this).data('rating');

    //     alert(rating_data);

    // });

</script>