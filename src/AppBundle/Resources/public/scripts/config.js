"use strict";

angular.module(
	'config', []
)
.constant(
	'ENV', {
		name: 'development',
		endpoint: 'http://redeemar-backend.local'
	}
);