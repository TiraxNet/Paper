function GCTmpEdit(){}
GCTmpEdit.prototype = {
	addBackImg : function(src) {
		jc.rect(0,0,10000,10000,'rgba(0,0,0,0.0)').level(10).id('all');
		var img = new Image();
		img.src = src;
		img.onload = function() {
			jc.image(img, 0, 0).level(-1).id('backImg');
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
			.level(11)
			;
	},
	addAllBlocks : function (blocks){
		for (var i=0;i<blocks.length;i++){
			this.addBlock(blocks[i]);
		}
	},
	activeBlock : function(id) {
		var new_block = new Object;
		new_block.drawing=false;
		jc('#block_'+id).color('rgba(135,255,135,0.5)');
		jc('#all').mousedown(function(point){
			jc('#block_'+id).del();
			new_block.x=point.x;
			new_block.y=point.y;
			new_block.drawing=true;
			$('body').css('cursor', 'crosshair');
		});
		jc('#all').mouseup(function(point){
			new_block.drawing=false;
			$('body').css('cursor', 'default');
		});
		jc('#all').mousemove(function(point){
			if (new_block.drawing==true){
				jc('#block_'+id).del();
				new_block.width=point.x-new_block.x;
				new_block.height=point.y-new_block.y;
				new_block.color='rgba(135,255,135,0.5)';
				new_block.fill=true;
				jc.rect(new_block)
					.id('block_'+id)
					.level(1);
			}
		});
		
	}
}

