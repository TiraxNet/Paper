//(function (window, undefined) {
var gc = {
	tmp : null,
	init : function(tmp, backUrl) {
		this.tmp = tmp
		jc.start('mainCanvas', true);
		this.addBackImg(backUrl);
		this.blocks.loadBlocks();
		this.initIcons();
	},
	initIcons : function() {
		gc.icons.clear();
		this.icons.add('plus', function(){
			gc.blocks.addNew();
		});
	},
	addBackImg : function(src) {
		jc.rect(30, 0, 10000, 10000, 'rgba(0,0,0,0.0)').level(10).id('all');
		var img = new Image();
		img.src = src;
		img.onload = function() {
			jc.image(img, 30, 0).level(-1).id('backImg');
		}
	},
	refresh : function(){
		this.initIcons();
		this.blocks.refresh();
		jc('#all').del();
		jc.rect(30, 0, 10000, 10000, 'rgba(0,0,0,0.0)').level(10).id('all');
	},
	reload : function() {
		this.initIcons();
		this.blocks.reloadAll();
		jc('#all').del();
		jc.rect(30, 0, 10000, 10000, 'rgba(0,0,0,0.0)').level(10).id('all');
	},
	block : function(id) {
		if (id === undefined)
			return gc.blocks;
		else {
			b = new gcproto.block(id);
			return b;
		}
	}
}
gc.blocks = {
	_actived_block : null,
	_block_array : new Array(),
	loadBlocks : function() {
		data = {
			id : gc.tmp
		};
		$.getJSON("index.php?r=admin/block/JsonList", data)
		.done(function(resault) {
			gc.blocks._block_array = resault;
			gc.blocks.refresh();
		}).fail(function() {
			gc.msg.addError('Error while Loading blocks');
		});
	},
	refresh : function(){
		gc.blocks.clear();
		gc.blocks.addAllBlocks();
	},
	add : function(block) {
		jc.rect(parseInt(block.x1) + 30, block.y1, block.x2 - block.x1,
				block.y2 - block.y1, 'rgba(255,156,135,0.5)', true).id(
				"block_" + block.id).level(11).job(function() {
			gc.blocks.activeBlock(block.id);
		});
	},
	addAllBlocks : function() {
		for ( var i = 0; i < this._block_array.length; i++) {
			this.add(this._block_array[i]);
		}
	},
	reloadAll : function() {
		this.loadBlocks();
	},
	unjobAll : function() {
		for ( var i = 0; i < this._block_array.length; i++) {
			// this.unjob(this._block_array[i].id);
			gc.block(this._block_array[i].id).unjob();
		}
	},
	clear : function() {
		for ( var i = 0; i < this._block_array.length; i++) {
			gc.block(this._block_array[i].id).del();
		}
		gc.block('new').del();
	},
	activeBlock : function(id) {
		this._actived_block = id;
		gc.block(id).selectable();
		gc.block(id).loadOptions();
		gc.icons.clear();
		gc.icons.addCancel();
		gc.icons.add('tick', function() {
			gc.block(gc.blocks._actived_block).savePos();
			gc.block(gc.blocks._actived_block).saveOptions();
		});
		gc.icons.add('gear', function() {
			gc.block(id).openOptions();
		});
	},
	addNew : function(){
		gc.block('new').selectable();
		gc.icons.clear();
		gc.icons.addCancel();
		gc.icons.add('tick', function() {
			gc.block('new').saveNew();
		});
	}
}
gc.icons = {
	pointer : 0,
	add : function(icon, fn) {
		var icons = {
			tick : {
				x : 64,
				y : 144
			},
			plus : {
				x : 16,
				y : 128
			},
			gear : {
				x : 192,
				y:112
			},
			closeThick : {
				x : 96,
				y : 128
			},
			close : {
				x : 80,
				y : 128
			}
		}
		var img = new Image();
		img.src = "publics/images/icons.png";
		img.onload = function() {
			jc.image(img, 0, gc.icons.pointer * 30, 30, 30, icons[icon].x,
					icons[icon].y, 16, 16).job(fn).id(
					'icon_' + gc.icons.pointer);
			gc.icons.pointer++;
		}
	},
	addCancel : function(){
		gc.icons.add('close', function(){
			gc.refresh();
		});
	},
	clear : function() {
		for ( var i = 0; i < this.pointer; i++) {
			jc('#icon_' + i).del();
		}
		gc.icons.pointer = 0;
	},
	addNew : function(){
		this.block('new').selectable();
	}
}
gc.msg = {
	addSuccess : function(msg) {
		$('#msg').html('<div class="alert alert-success">' + msg + '</div>');
	},
	addError : function(msg) {
		$('#msg').html('<div class="alert alert-error">' + msg + '</div>');
	}
}

jc.addFunction('link', function(href) {
	this.click(function() {
		window.location.href = href;
	}).mouseover(function() {
		$('body').css('cursor', 'pointer');
	}).mouseout(function() {
		$('body').css('cursor', 'default');
	})
	return this;
});
jc.addFunction('job', function(fn) {
	this.click(fn).mouseover(function() {
		$('body').css('cursor', 'pointer');
	}).mouseout(function() {
		$('body').css('cursor', 'default');
	})
	return this;
});

/** ***********************New Type*******************/
var gcproto = {}
gcproto.block = function(id) {
	this.id = id;
	this.jb = jc("#block_" + id);
	
	this.del = function() {
		this.jb.del();
	}
	this.unjob = function() {
		$('body').css('cursor', 'default');
		this.jb.click(function() {
		}).mouseover(function() {
		}).mouseout(function() {
		})
	}
	this.savePos = function() {
		rect = this.jb.getRect('poor');
		var data = {
			block : id,
			x : (rect.x - 30) || 0,
			y : (rect.y) || 0,
			width : (rect.width) || 0,
			height : (rect.height) || 0
		};
		$.getJSON("index.php?r=admin/block/savePos", data)
			.done(function(resault) {
				gc.msg.addSuccess(resault.m);
				gc.reload();
			})
			.fail(function() {
				gc.msg.addError('Error while saving block');
			});
	}
	this.loadOptions = function() {
		$.get("index.php?r=admin/block/blockOptions", {block:id})
			.done(function(resault) {
				$('#blockOptions').html(resault);
			})
			.fail(function() {
				gc.msg.addError('Error while loading block options.');
			});
	}
	this.openOptions = function (){
		$('#OptionsDialog').modal();
	}
	this.saveOptions = function (){
		data=$('#OptionsForm').serialize();
		$.post($('#OptionsForm').attr('action'),data,undefined,'json')
			.done(function(resault) {
				gc.msg.addSuccess(resault.m);
			})
			.fail(function() {
				gc.msg.addError('Error while saving block.');
			});
	}
	this.selectable = function() {
		gc.blocks.unjobAll();
		var new_block = new Object;
		new_block.drawing = false;
		this.jb.color('rgba(135,255,135,0.5)');
		jc('#all').mousedown(function(point){
			jc('#block_' + id).del();
			new_block.x = point.x;
			new_block.y = point.y;
			new_block.drawing = true;
			$('body').css('cursor', 'crosshair');
		});
		jc('#all').mouseup(function(point) {
			new_block.drawing = false;
			$('body').css('cursor', 'default');
		});
		jc('#all').mousemove(function(point) {
			if (new_block.drawing == true) {
				jc('#block_' + id).del();
				new_block.width = point.x - new_block.x;
				new_block.height = point.y - new_block.y;
				new_block.color = 'rgba(135,255,135,0.5)';
				new_block.fill = true;
				jc.rect(new_block).id('block_' + id).level(1);
			}
		});
	}
	this.saveNew = function() {
		jb = this.jb;
		$('#newBlockSaveBtn').click(function(){
			rect = jb.getRect('poor');
			var data = {
				id : gc.tmp,
				x : (rect.x - 30) || 0,
				y : (rect.y) || 0,
				width : (rect.width) || 0,
				height : (rect.height) || 0
			};
			var d1 = $.param(data);
			var d2 = $('#newBlock').serialize();
			data = d1 + '&' + d2;
			console.log(data);
			$('#newBlockDialog').modal('hide');
			$.post("index.php?r=admin/block/saveNew", data, undefined, 'json')
				.done(function(resault) {
					gc.msg.addSuccess(resault.m);
					gc.reload();
				})
				.fail(function() {
					gc.msg.addError('Error while saving new block');
				});
		});
		$('#newBlockDialog').modal('show');

	}
}
// })(window, undefined);
