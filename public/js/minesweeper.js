class Minesweeper {

	constructor() {
		this.size = 3;
		this.time = 120;
		this.mineCount = Math.ceil(this.size * 1.5);
		this.mines = [];

		this.random = [30, 62, 80, 35, 70, 93, 46, 40, 79, 78, 98, 38, 88, 86, 39, 89, 99, 53, 91, 72, 48, 52,  4, 11, 95, 25, 65, 21, 97, 29, 58, 56, 43, 49,  8, 34, 44, 94, 10, 85, 23, 54, 61,  1, 36,  6,  2, 26, 67, 37, 59, 81, 74, 82, 73, 24, 28, 17, 42, 14, 16, 92, 18, 13, 31,  5, 87, 32,  0, 75, 68, 50, 77, 15, 55, 12, 96,  3, 60, 66, 71, 84,  9, 51, 90, 64, 69, 41, 20, 19,  7, 45, 47, 63, 22, 33, 27, 76, 83, 57];
		this.makeGame();
		setInterval(this.gameTick.bind(this), 1000);

		this.playing = false;
		this.ended = false;
		this.cleared = 0;
		this.result = jQuery('#result');
		this.anchor = jQuery('#minesweeper');
		this.timer = jQuery('#timer');
		
		this.mines.forEach((row, rowIndex) => {
			row.forEach((cell, columnIndex) => {
				if (this.mines[rowIndex][columnIndex] == '*') {

					for(var i = -1; i < 2; i++){
						for(var j = -1; j < 2; j++){
							if(i == 0 && j == 0){
								continue;
							}
							if(parseInt(rowIndex+i) < 0 || parseInt(rowIndex+i) >= this.size){
								continue;
							}
							if(parseInt(columnIndex+j) < 0 || parseInt(columnIndex+j) >= this.size){
								continue;
							}

							if(this.mines[parseInt(rowIndex+i)][parseInt(columnIndex+j)] != '*'){
								this.mines[parseInt(rowIndex+i)][parseInt(columnIndex+j)]++;
							}
						}
					}				
				}
			});
		});		

		this.mines.forEach((row, rowIndex) => {
			row.forEach((cell, columnIndex) => {
				this.anchor.append(
					'<div class="cell covered">&#9675</div>'
				)
				.children('.cell:last-child')
				.click((event) => {this.handleCellClick(rowIndex, columnIndex, jQuery(event.target))})
				.bind('contextmenu', (event) => {this.handleCellFlag(rowIndex, columnIndex, event)});
			});
			this.anchor.append('<br>');
		});
	}

	handleCellClick(row, column, obj) {
		if(!this.ended){
			this.playing = true;
		}
		if(this.playing && obj.hasClass('covered')){
			obj.removeClass('covered');
			var mine = this.mines[row][column];
			obj.html(mine);
			if(mine == '*'){
				this.playing = false;
				this.ended = true;
				this.result.html('Congratulations! You lost!');
				jQuery.post('/scores', {score: 0, "_token": jQuery('#token').val()})
			}
			else{
				this.cleared++;
				if(this.cleared == this.size*this.size - this.mineCount){
					this.playing = false;
					this.ended = true;
					this.result.html('Congratulations! You Won!');
					jQuery.post('/scores', {score: this.time, "_token": jQuery('#token').val()})
				}
			}
		}
	}
	handleCellFlag(row, column, event) {
		event.preventDefault();
		if(this.playing){
			var obj = jQuery(event.target);
			if(!obj.hasClass('covered')){
				return;
			}
			if(obj.hasClass('flagged')){
				obj.html('&#9675');
			}
			else{
				obj.html('&#9679');
			}
			obj.toggleClass('flagged');
		}
	}
	makeGame() {
		var board = Array(this.size * this.size);
		board.fill(0, 0, this.size * this.size);
		var seed = '123';

		var i = 0;
		var j = 0;
		while(j < this.mineCount){
			var index = this.generateNumber(seed+i);
			if(board[index] == '*'){
				i++
				continue;
			}
			board[index] = '*';
			i++;
			j++;
		}
		for(var i = 0; i < this.size; i++){
			this.mines[i] = board.slice(this.size * i, this.size * (i+1));
		}
	}
	generateNumber(seed) {
		var chars = seed.split('');
		var sum = 0;
		chars.forEach((char) => {
			sum += char.charCodeAt(0) << 4;
		});
		var pos = sum % this.random.length;
		return this.random[pos] % (this.size * this.size);
	}
	gameTick() {
		console.log(this.playing);
		if(this.playing){
			this.time--;
			this.timer.html('Time: '+this.time);
			if(this.time <= 0){
				this.ended = true;
				this.playing = false;
				this.result.html('Congratulations! You lost!');
				jQuery.post('/scores', {score: 0, "_token": jQuery('#token').val()})
			}
		}
	}
}


