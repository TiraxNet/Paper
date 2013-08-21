function GCTmpEdit(tmpId){
		this.tmpId=tmpId;
}
GCTmpEdit.prototype = {
	addBackImg : function(src) {
		var img = new Image();
		img.src = src;
		img.onload = function() {
			jc.image(img, 0, 0).level(-1);
		}
	},
	addBlock : function(x1, y1, x2, y2, id) {
		var parent = this;
		jc.rect(x1, y1, x2 - x1, y2 - y1, 'rgba(255,156,135,0.5)', true)
			.id("block_" + id)
			.click(function() {
					window.location.href = "index.php?r=admin/block/edit&tmp="
							+ parent.tmpId + "&block=" + id;
			})
			.mouseover(function(){
				$('body').css('cursor', 'pointer'); 
			})
			.mouseout(function(){
				$('body').css('cursor', 'default');
			})
			;
	}
}

