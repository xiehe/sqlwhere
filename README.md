# sqlwhere
PHP一个函数, 处理sql中的where拼装, 数组书写查看起来比较清晰。

## 例子 example
```php
$where = [
	'b' => 'bb',
	'<' => [
		'num' => 10
	],
	'IN' => [
		'bc' => [2, 4, 5]
	],
	'LIKE' => [
		'name' => 'J%'
	],
	[
		'LIKE' => [
			'username' => 'He%'
		]
	],
	'OR' => [
		[
			['a' => 'aa'],
			['b' => 'bb']
		],
		[
			['c' => 'cc'],
			['OR' => [
				'd' => 'dd',
				'e' => 'ee'
			]]
		]
	]
];
```
