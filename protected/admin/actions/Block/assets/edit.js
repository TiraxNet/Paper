var XOffset;
var YOffset;
var SelectHndl;
var EnCancelSelect=0;
function ready(){
	XOffset = $("#MainIMG").offset().left;
	YOffset = $("#MainIMG").offset().top;
}
function NewReady(){
	SelectHndl=$('#MainIMG').imgAreaSelect({
		onSelectEnd: function (img, selection) {
			if(validate(selection.x1,selection.y1,selection.x2,selection.y2)==true){
				$('.imgareaselect-outer').css({ 'background-color': 'green'});
				$('#x1').val(selection.x1);
				$('#y1').val(selection.y1);
				$('#x2').val(selection.x2);
				$('#y2').val(selection.y2);
			}else{
				$('.imgareaselect-outer').css({ 'background-color': 'red'});
			}
		}
	});
}
function EditReady(x1,y1,x2,y2){
	SelectHndl=$('#MainIMG').imgAreaSelect({instance: true,
		x1: x1, y1: y1, x2: x2, y2: y2,
		onSelectEnd: function (img, selection) {
			if(validate(selection.x1,selection.y1,selection.x2,selection.y2)==true){
				$('.imgareaselect-outer').css({ 'background-color': 'green'});
				$('#x1').val(selection.x1);
				$('#y1').val(selection.y1);
				$('#x2').val(selection.x2);
				$('#y2').val(selection.y2);
			}else{
				$('.imgareaselect-outer').css({ 'background-color': 'red'});
			}
		}
	});
	$('#EditBlockPosSave').click(function (){$('#EditBlockPosForm').submit()} );
	EnCancelSelect=1;
}
function validate(x1,y1,x2,y2){
	for (var i=0; i<blocks.length; i++){
		block=blocks[i];
		if (block[0]<x1 && block[2]>x1 && block[1]<y1 && block[3]>y1){return false;}//Check Top-Left corner
		if (block[0]<x2 && block[2]>x2 && block[1]<y2 && block[3]>y2){return false;}//Check Bottom-Right corner
		if (block[0]<x1 && block[2]>x1 && block[1]<y2 && block[3]>y2){return false;}//Check Bottom-Left corner
		if (block[0]<x2 && block[2]>x2 && block[1]<y1 && block[3]>y1){return false;}//Check Top-Rihgt corner
		
		if (((x1>block[0] && x1<block[3]) || (x2>block[0] && x2<block[3]))
			&& y1<block[1] && y2>block[3]){return false;} //Not corners But...!
		if (((y1>block[1] && y1<block[4]) || (y2>block[1] && y2<block[4]))
			&& x1<block[0] && x2>block[2]){return false;} //Not corners But...!
		
	}
	return true;
}
function CancelSelect(){
	if (EnCancelSelect==1){
		$('#x1').val(0);
		$('#y1').val(0);
		$('#x2').val(0);
		$('#y2').val(0);
	}
	
}