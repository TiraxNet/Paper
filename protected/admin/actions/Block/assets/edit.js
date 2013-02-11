/**
 * Picture's X offset will be stored in XOffset
 */
var XOffset;
/**
 * Picture's Y offset will be stored in YOffset
 */
var YOffset;
/**
 * imgAreaSelect instance object
 */
var SelectHndl;
/**
 * User could cancel selection!
 */
var EnCancelSelect=0;
/**
 * When document is ready, set offsets
 */
function ready(){
	XOffset = $("#MainIMG").offset().left;
	YOffset = $("#MainIMG").offset().top;
}
/**
 * Create Select handle in order to Create New block
 */
function NewReady(){
	SelectHndl=$('#MainIMG').imgAreaSelect({
		instance: true,
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
/**
 * Create Select handle in order to editing current block position
 * @param x1
 * @param y1
 * @param x2
 * @param y2
 */
function EditReady(x1,y1,x2,y2){
	SelectHndl=$('#MainIMG').imgAreaSelect({
		instance: true,
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
/**
 * Validate Current selection depending on other blocks
 * @param x1
 * @param y1
 * @param x2
 * @param y2
 * @returns {Boolean}
 */
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
/**
 * No selection!
 */
function CancelSelect(){
	if (EnCancelSelect==1){
		$('#x1').val(0);
		$('#y1').val(0);
		$('#x2').val(0);
		$('#y2').val(0);
	}
	
}
/**
 * Fix block position depending on other blocks in order to decrease table pieces
 */
function FixBlockPosition(){
	var Selection=SelectHndl.getSelection(true);
	var NewSelection=SelectHndl.getSelection(true);
	
	var x1BestOffset=30;
	var x2BestOffset=30;
	var y1BestOffset=30;
	var y2BestOffset=30;
	
	for (var i=0; i<blocks.length; i++){
		block=blocks[i];
		
		//Fix Top-Left->X
		if (Math.abs(Selection.x1-block[0])<x1BestOffset && block[0]<Selection.x2) {
			NewSelection.x1=block[0];
			x1BestOffset=Math.abs(Selection.x1-block[0]);
		}
		if (Math.abs(Selection.x1-block[2])<x1BestOffset && block[2]<Selection.x2) {
			NewSelection.x1=block[2];
			x1BestOffset=Math.abs(Selection.x1-block[2]);
		}
		
		//Fix Top-Left->Y
		if (Math.abs(Selection.y1-block[1])<y1BestOffset && block[1]<Selection.y2) {
			NewSelection.y1=block[1];
			y1BestOffset=Math.abs(Selection.y1-block[1]);
		}
		if (Math.abs(Selection.y1-block[3])<y1BestOffset && block[3]<Selection.y2) {
			NewSelection.y1=block[3];
			y1BestOffset=Math.abs(Selection.y1-block[3]);
		}
		
		//Fix Bottom-Right->X
		if (Math.abs(Selection.x2-block[0])<x2BestOffset && block[0]>Selection.x1) {
			NewSelection.x2=block[0];
			x2BestOffset=Math.abs(Selection.x2-block[0]);
		}
		if (Math.abs(Selection.x2-block[2])<x2BestOffset && block[2]>Selection.x1) {
			NewSelection.x2=block[2];
			x2BestOffset=Math.abs(Selection.x2-block[2]);
		}
		
		//Fix Bottom-Right->Y
		if (Math.abs(Selection.y2-block[1])<y2BestOffset && block[1]>Selection.y1) {
			NewSelection.y2=block[1];
			y2BestOffset=Math.abs(Selection.y2-block[1]);
		}
		if (Math.abs(Selection.y2-block[3])<y2BestOffset && block[3]>Selection.y1) {
			NewSelection.y2=block[3];
			y2BestOffset=Math.abs(Selection.y2-block[3]);
		}
		
	}
	SelectHndl.setSelection(NewSelection.x1,NewSelection.y1,NewSelection.x2,NewSelection.y2,true);
	SelectHndl.update();
}