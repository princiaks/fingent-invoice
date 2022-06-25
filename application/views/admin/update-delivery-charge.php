
      <!-- Page Content Food Master Categories  -->
      <style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

</style>
      <div id="content-page" class="content-page">
         <div class="container-fluid">
        
            <div class="row">
               
               <div class="col-lg-12">
                   <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Update Delivery Charge Range</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                          
                           <form id="update_delivery_charge" method="POST" action="update_delivery_charge" data-form="ajaxform" enctype="multipart/form-data">
                              <?php if($deliverycharges){
                                 $flag=true;
                                 ?>
                                   <div class="repeat_field">
                                 <?php
                                 foreach($deliverycharges as $details)
                                 {
                                    if($flag)
                                    {
                                       ?>
                                      
                              <div class="form-row">
                                  <div class="col-md-3">
                                  <label></label>
                                    <input type="number" class="form-control" placeholder="From" name="range_from[]" value="<?php echo $details->range_from;?>" required step="0.01">
                                 </div>
                                 <div class="col-md-1">
                                  <label></label>
                                    <input type="number" class="form-control border-none bg-white" placeholder="To"  readonly>
                                 </div>
                                 <div  class="col-md-3">
                                  <label></label>
                                    <input type="number" class="form-control" placeholder="To" name="range_to[]" value="<?php echo $details->range_to;?>" required step="0.01">
                                 </div>
                                 <div class="col-md-3">
                                  <label></label>
                                    <input type="number" class="form-control" placeholder="Charge" name="charge[]" value="<?php echo $details->charge;?>" required step="0.01">
                                 </div>
                                 <div class="col-md-2">
                                 <label></label>
                                  <input type="button" name="add" value="+"class=" p-1 form-control text-white add_more" style="max-width: 40px; background-color:green"/>
                                 </div>
								          
                              </div>
                           
                                       <?php
                                       $flag=false;
                                    }
                                    else
                                    {
                                       ?>
                                       <div class="form-row">
    <div class="col-md-3">
    <label></label>
      <input type="number" class="form-control" placeholder="From" name="range_from[]" value="<?php echo $details->range_from;?>" required  step="0.01">
   </div>
   <div class="col-md-1">
    <label> </label>
      <input type="number" class="form-control border-none bg-white" placeholder="To" readonly>
   </div>
   <div  class="col-md-3">
    <label> </label>
      <input type="number" class="form-control" placeholder="To" name="range_to[]" value="<?php echo $details->range_to;?>" required  step="0.01">
   </div>
   <div class="col-md-3">
    <label> </label>
      <input type="number" class="form-control" placeholder="Charge" name="charge[]" value="<?php echo $details->charge;?>" required  step="0.01">
   </div>
   <div class="col-md-2">
   <label> </label>
   <input
   type="button"
   id="removebtn"
   name="add"
   value="-"
   class=" p-1 form-control text-white remove" style="max-width: 40px; background-color:pink"
   />
   
     </div>
   

</div>
                                       <?php
                                    }
                                 }
                                 ?>
                                   </div>
                                 <?php
                                 }
                                 else
                                 {?>
                           <div class="repeat_field">
                              <div class="form-row">
                                  <div class="col-md-3">
                                  <label> </label>
                                    <input type="number" class="form-control" placeholder="From" name="range_from[]" value="" required step="0.01">
                                 </div>
                                 <div class="col-md-1">
                                  <label> </label>
                                    <input type="number" class="form-control border-none bg-white" placeholder="To"  value="" readonly>
                                 </div>
                                 <div  class="col-md-3">
                                  <label> </label>
                                    <input type="number" class="form-control" placeholder="To" name="range_to[]" value="" required step="0.01">
                                 </div>
                                 <div class="col-md-3">
                                  <label> </label>
                                    <input type="number" class="form-control" placeholder="Charge" name="charge[]" value="" required step="0.01">
                                 </div>
                                 <div class="col-md-2">
                                 <label> </label>
                                  <input type="button" name="add" value="+"class=" p-1 form-control text-white add_more" style="max-width: 40px; background-color:green"/>
                                 </div>
								          
                              </div>
                           </div>
                           <?php }?>
							
							  
							  	  <div class="form-row" style="padding-top:50px;">
                                 
                             
							
								  <div class="col">
                          <button type="submit" class="btn btn-primary">Update Charge</button>
                                 </div>
								
								 
                              </div>
							  
							  
							  
							   
                          
                              
                           </form>
                        </div>
                     </div></div>
            </div>
      
         </div>
      </div>
  