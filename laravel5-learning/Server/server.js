var	Redis = require('ioredis'),
	redis = new Redis();
redis.psubscibe('*', function(error, count){
	
});

redis.on('pmessage', function(pattern, channel, message){
	message = JSON.parse(message);
	io.emit(channel + ':' + message.data.message);
});