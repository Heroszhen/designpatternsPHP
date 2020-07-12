<?php
namespace Strategy;

class QuickSort implements ISort{
	public function run(Array $tab){
		$loe = $gt = array();
		if(count($tab) < 2)
		{
			return $tab;
		}
		$pivot_key = key($tab);
		$pivot = array_shift($tab);
		foreach($tab as $val)
		{
			if($val <= $pivot)
			{
				$loe[] = $val;
			}elseif ($val > $pivot)
			{
				$gt[] = $val;
			}
		}
		return array_merge($this->run($loe),array($pivot_key=>$pivot),$this->run($gt));
	}


}