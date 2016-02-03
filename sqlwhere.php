function whereGenerate($where, $concat = 'AND') {
		if (is_array($where)) {
			$whereAssembly = function (&$val, $key) {
				if (is_numeric($key)) {
					// [[k1=>v1],[k2=>v2]]
					$val = self::whereGenerate($val, 'AND');
				} elseif (!is_array($val)) {
					$val = " $key = '{$val}' ";
				} elseif (in_array($key, ['AND', 'OR'])) {
					$val = self::whereGenerate($val, $key);
				} else {
					$curKey = key($val);
					$curVal = current($val);
					switch ($key) {
						case 'IN':
						case 'NOT IN':
							$val = " $curKey ".$key."('".implode("','", $curVal)."') ";
						break;
						case '<':
						case '>':
						case '>=':
						case '<=':
						case 'LIKE':
							$val = " $curKey $key '{$curVal}' ";
						break;
					}
				}
			};
			array_walk($where, $whereAssembly);

			// 当or时加括号
			if ($concat == 'OR') {
				return ' (('.implode(') '.$concat.' (', $where).')) ';
			} else {
				return implode($concat, $where);
			}
		}

		return $where;
	}
