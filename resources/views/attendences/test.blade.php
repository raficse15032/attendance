@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Attendences</h1>
        <h1 class="pull-right">
        	<!-- <button onclick="generate()">generate PDF</button> -->
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div id="content2" class="box box-primary scrollmenu">
        	<div style="margin-left:calc(50% - 100px);padding-bottom: 20px;" class="col-md-12 text-center">
        		<div class="row">
        			<div class="col-md-2">
        				<img style="height: 100px;margin-left: 10px;" src="{{url('img/logo.png')}}">
        			</div>
        			<div class="col-md-4">
        				<h4>Department of Computer Science and Engineering (CSE)</h4>
        				<h5>Mawlana Bhashani Science and Technology University</h5>
        				<h6>Attendence Sheet</h6>
        			</div>
        		</div>
        	</div>
        	<div style="padding-bottom: 20px;" class="col-md-12">
        		<div class="row">
        			<div class="col-md-2">
        				<h5><b>Course Code:</b> {{$course->course_code}}</h5>
        			</div>
        			<div class="col-md-4">
        				<h5><b>Course Title:</b> {{$course->course}}</h5>
        			</div>
        		</div>
        	</div>
            <div class="box-body ">
                <table class="table " id="attendences-table">
				    <thead>
				        <tr>
				            <th>Student ID</th>
				            <th>Name</th>
				            @foreach($attendences as $attendence)
				            <th>
				            	{{$attendence->created_at->format('d')}}<br>
				            	{{$attendence->created_at->format('m')}}<br>
				            	{{$attendence->created_at->format('y')}}<br>
				            </th>
				            @endforeach
				            <th>Total <br> Class</th>
				            <th>Percentage of <br> Attendence</th>
				            <th>Attend.<br>Marks</th>
				            <th>CT 1 <br> Date:@if(sizeof($ct_marks)==1 || sizeof($ct_marks)==2 || sizeof($ct_marks)==3 || sizeof($ct_marks)==4)<br>{{$ct_marks[0]->created_at->format('d-m')}}@endif</th>
				            <th>CT 2 <br> Date:@if(sizeof($ct_marks)==2 || sizeof($ct_marks)==3 || sizeof($ct_marks)==4)<br>{{$ct_marks[1]->created_at->format('d-m')}}@endif</th>
				            <th>CT 3 <br> Date:@if(sizeof($ct_marks)==3 || sizeof($ct_marks)==4)<br>{{$ct_marks[2]->created_at->format('d-m')}}@endif</th>
				            <th>CT 4 <br> Date:@if(sizeof($ct_marks)==4)<br>{{$ct_marks[3]->created_at->format('d-m')}}@endif</th>
				            <th>Total</th>
				            <th>Remarks</th>
				        </tr>
				    </thead>
				    <tbody>
				    	@foreach($students as $student)
				    	<?php 
				    		$count = 0;
				    		$at_mark = 0;
				    		$percentage  = 0;
				    		$ct1 = 110;
				    		$ct2 = 110;
				    		$ct3 = 110;
				    		$ct4 = 110;
				    		$total = 0
				    	 ?>
				    	
				        <tr>
				            <td>{{$student->identity}}</td>
				            <td>{{$student->name}}</td>
				            @foreach($attendences as $attendence)
				            	@foreach(json_decode($attendence->attendence) as $attend_student)
				            		@if($attend_student->identity == $student->identity)
				            		<td>
				            			@if($attend_student->attendence == 1)
				            			<i class="fa fa-check"></i>
				            			@else
				            			<i class="fa fa-times"></i>
				            			@endif
				            		</td>
				            		@endif
				            	@endforeach
				            @endforeach
				            <td>{{$total_class}}</td>
				            <td>
				            	@foreach($attendences as $attendence)
					            	@foreach(json_decode($attendence->attendence) as $attend_student)
					            		@if($attend_student->identity == $student->identity)
					            			@if($attend_student->attendence == 1)
					            				<?php 
					            					$count = $count + 1;
					            				 ?>
					            			@endif
					            		@endif
					            	@endforeach
					            @endforeach
					            <?php 
					            	$percentage = (($count/$total_class)*100);
					             ?>
					             {{round($percentage,2)}}%
				            </td>
				            <td>
				            	@if($percentage>=90)
				            		<?php 
				            			$at_mark = 10;
				            		 ?>
				            		 {{$at_mark}}
				            	@elseif($percentage>=80)
				            		<?php 
				            			$at_mark = 9;
				            		 ?>
				            		 {{$at_mark}}
				            	@elseif($percentage>=70)
				            		<?php 
				            			$at_mark = 8;
				            		 ?>
				            		 {{$at_mark}}
				            	@elseif($percentage>=60)
				            		<?php 
				            			$at_mark = 7;
				            		 ?>
				            		 {{$at_mark}}
				            	@elseif($percentage>=50)
				            		<?php 
				            			$at_mark = 6;
				            		 ?>
				            		 {{$at_mark}}
				            	@elseif($percentage>=40)
				            		<?php 
				            			$at_mark = 5;
				            		 ?>
				            		 {{$at_mark}}
				            	@elseif($percentage>=30)
				            		<?php 
				            			$at_mark = 4;
				            		 ?>
				            		 {{$at_mark}}
				            	@elseif($percentage>=20)
				            		<?php 
				            			$at_mark = 3;
				            		 ?>
				            		 {{$at_mark}}
				            	@elseif($percentage>=10)
				            		<?php 
				            			$at_mark = 2;
				            		 ?>
				            		 {{$at_mark}}
				            	@elseif($percentage>=1)
				            		<?php 
				            			$at_mark = 1;
				            		 ?>
				            		 {{$at_mark}}
				            	@else
				            		<?php 
				            			$at_mark = 0;
				            		 ?>
				            		 {{$at_mark}}
				            	@endif
				            </td>
				            
				            
				            @foreach($ct_marks as $ct_mark)
				            	@foreach(json_decode($ct_mark->marks) as $mark)
				            		@if($mark->identity == $student->identity)
					            		@if($ct_mark->ct==1)
					            		<td>
					            			<?php $ct1 = $mark->mark ?>
					            			{{$ct1}}
					            		</td>
					            		@elseif($ct_mark->ct==2)
					            		<td>
					            			<?php $ct2 = $mark->mark ?>
					            			{{$ct2}}
					            		</td>
					            		@elseif($ct_mark->ct==3)
					            		<td>
					            			<?php $ct3 = $mark->mark ?>
					            			{{$ct3}}
					            		</td>
					            		@elseif($ct_mark->ct==4)
					            		<td>
					            			<?php $ct4 = $mark->mark ?>
					            			{{$ct4}}
					            		</td>
					            		@endif
				            		@endif
				            	@endforeach
				            @endforeach
				            @if(sizeof($ct_marks) == 0)
				            <td>-</td>
				            <td>-</td>
				            <td>-</td>
				            <td>-</td>
				            @elseif(sizeof($ct_marks) == 1)
				            <td>-</td>
				            <td>-</td>
				            <td>-</td>
				            @elseif(sizeof($ct_marks) == 2)
				            <td>-</td>
				            <td>-</td>
				            @elseif(sizeof($ct_marks) == 3)
				            <td>-</td>
				            @endif
				            <td>
				            	<?php 
					            	if($ct1==110 && $ct2==110 && $ct3==110 && $ct4==110){
					            		$total = $at_mark;
					            	}
					            	else if($ct2==110 && $ct3==110 && $ct4==110){
					            		$total = $at_mark+$ct1;
					            	}
					            	else if($ct3==110 && $ct4==110){
					            		$total = $at_mark+($ct1+$ct2)/2;
					            	}
					            	else if($ct4==110){
					            		$total = $at_mark+($ct1+$ct2+$ct3)/3;
					            	}
					            	else{
					            		if($ct1>$ct4 && $ct2>$ct4 &&  $ct3>$ct4){
					            			$total = $at_mark+($ct1+$ct2+$ct3)/3;
					            		}
					            		if($ct1>$ct3 && $ct2>$ct3 &&  $ct4>$ct3){
					            			$total = $at_mark+($ct1+$ct2+$ct4)/3;
					            		}
					            		if($ct1>$ct2 && $ct3>$ct2 &&  $ct4>$ct2){
					            			$total = $at_mark+($ct1+$ct4+$ct3)/3;
					            		}
					            		if($ct2>$ct1 && $ct3>$ct1 &&  $ct4>$ct1){
					            			$total = $at_mark+($ct4+$ct2+$ct3)/3;
					            		}
					            	}
					            ?>
					            {{round($total,2)}}
				            </td>
				            <td>{{$student->remarks}}</td>
				        </tr>
				        @endforeach
				    </tbody>
				</table>
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection
@section('css')
<style type="text/css">
	div.scrollmenu {
	  overflow: auto;
	  white-space: nowrap;
	}
</style>
@endsection
@section('scripts')
<script type="text/javascript">
	// var doc = new jsPDF();
	// var specialElementHandlers = {
	//     '#editor': function (element, renderer) {
	//         return true;
	//     }
	// };

	// $('#cmd').click(function () {
	//     var pdf = new jsPDF("p", "pt", "a4");
	// 	pdf.addHTML($('#content2'), 15, 15, function() {
	// 	  pdf.save('div.pdf');
	// 	});
	// });
	var base64Img = null;
margins = {
  top: 170,
  bottom: 40,
  left: 30,
  width: 550
};
	generate = function()
	{
	  var pdf = new jsPDF('p', 'pt', 'a4');
	  pdf.setFontSize(18);
	  pdf.fromHTML(document.getElementById('content2'), 
	    margins.left, // x coord
	    margins.top,
	    {
	      // y coord
	      width: margins.width// max width of content on PDF
	    },function(dispose) {
	      headerFooterFormatting(pdf)
	    }, 
	    margins);
	    
	  var iframe = document.createElement('iframe');
	  iframe.setAttribute('style','position:absolute;right:0; top:100; bottom:0; height:100%; width:650px; padding:20px;');
	  document.body.appendChild(iframe);
	  
	  iframe.src = pdf.output('datauristring');
	};
</script>
@endsection

