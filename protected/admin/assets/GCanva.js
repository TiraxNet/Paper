function GCTmpEdit(){}
GCTmpEdit.prototype = {
	addBackImg : function(src) {
		var img = new Image();
		img.src = src;
		img.onload = function() {
			jc.image(img, 0, 0).level(-1);
		}
	},
	addBlock : function(block) {
		jc.rect(block.x1, block.y1, block.x2 - block.x1, block.y2 - block.y1, 'rgba(255,156,135,0.5)', true)
			.id("block_" + block.id)
			.click(function() {
					window.location.href = block.href;
			})
			.mouseover(function(){
				$('body').css('cursor', 'pointer'); 
			})
			.mouseout(function(){
				$('body').css('cursor', 'default');
			})
			;
	},
	addAllBlocks : function (blocks){
		for (var i=0;i<blocks.length;i++){
			this.addBlock(blocks[i]);
		}
	}
}

