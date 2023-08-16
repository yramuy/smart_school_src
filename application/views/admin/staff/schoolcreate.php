<div class="content-wrapper">  
    <section class="content-header">
        <h1><i class="fa fa-sitemap"></i> <?php echo $this->lang->line('human_resource'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                	<form id="form1" action="<?php echo base_url('admin/staff/save_school') ?>"  id="employeeform" name="employeeform" method="post">
                        <div class="box-body">
                            
                            <div class="tshadow mb25 bozero">
                            	<h4 class="pagetitleh2"><?php echo $title; ?> </h4>
                            </div>
                            <div class="around10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo "School Name"; ?></label><small class="req"> *</small>
                                            <input autofocus="" id="school_name" name="school_name"  placeholder="" type="text" class="form-control"  value="" />
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo "Single/Multi Branch"; ?></label><small class="req"> *</small>
                                            <select id="branch" name="branch" class="form-control">
                                                <option>Select Branch</option>
                                                <option value="1">Branch 1</option>
                                                <option value="2">Branch 2</option>
                                                <option value="3">Branch 3</option>
                                                
                                            </select>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo "State"; ?></label><small class="req"> *</small>
                                            <select id="state" name="state" class="form-control">
                                                <option>Select State</option>

                                                <?php foreach($states as $st){?>
                                                    <option value="<?php echo $st["id"];?>"><?php echo $st["name"];?></option>
                                                <?php }?>
                                                
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo "District/City"; ?></label><small class="req"> *</small>
                                            <select id="city" name="city" class="form-control">
                                                <option>Select District/City</option>
                                                
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo "School Code"; ?></label><small class="req"> *</small>
                                            <input autofocus="" id="school_code" name="school_code"  placeholder="" type="text" class="form-control"  value="" />
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo "Password"; ?></label><small class="req"> *</small>
                                            <input autofocus="" id="password" name="password"  placeholder="" type="password" class="form-control"  value="" />
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/savemode.js"></script> 

<script type="text/javascript">
    $(document).on('change', '#state', function(e){

        $('#city').html("");
        var state_id = $(this).val();
        var base_url = '<?php echo base_url(); ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

        $.ajax({
            type: "GET",
            url: base_url + "admin/staff/getCities",
            data: {'state_id': state_id},
            dataType: "json",
            success: function(data){
                $.each(data, function(i, obj){
                    div_data += "<option value="+obj.id+">"+obj.name+"</option>";
                });

                $('#city').append(div_data);
            }
        });
    });
</script>