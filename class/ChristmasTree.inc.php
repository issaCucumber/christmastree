<?php

class ChristmasTreeNode{

	private $nodeId		= null			;
	private $parentId 	= null			; //if equals 0, the node is the star on the tree top
	private $children 	= array()		;

	function __construct($_node_id, $_parent_id){
		
		$this->nodeId 	= $_node_id		;
		$this->parentId = $_parent_id	;
		$this->children	= array()		;
	}

	public function getChildren(){
		return $this->children;
	}

	public function addChild($newChildNodeId){
		if(!in_array($newChildNodeId, $this->children)){
			$this->children[] = $newChildNodeId;
		}
	}

}

class ChristmasTree{
	private $the_tree = array(); //the main tree that store nodes, associative array
	
	/**
	 * public function addNode($_linkToId = null)
	 * @param string $_linkToId : the node id you want this new node to be linked to
	 * (if the tree is empty, this will be the very first node to be added to the tree)
	 * 
	 * @return nothing
	 */
	public function addNode($_linkToId = null){
		
		if(empty($this->the_tree)){
			//first node in the tree, let's light it up!
			$this->the_tree[1] = new ChristmasTreeNode(1, 0);
			return;
		}
		
		if(empty($_linkToId) || !array_key_exists($_linkToId, $this->the_tree)){
			return;
		}
		
		$newNodeId = count($this->the_tree) + 1; //let it be a running number
		$this->the_tree[$newNodeId] = new ChristmasTreeNode($newNodeId, $_linkToId);
		$this->the_tree[$_linkToId]->addChild($newNodeId);
		
	}
	
	/**
	 * private function findNodeCountAtLevel(&$levelLoop, $desiredLevel, $childrenAtThisLevel = array())
	 * 
	 * a recursive function to get the correct level and return the count of nodes at the level if levelLoop matches desiredLevel
	 * @param int $levelLoop
	 * @param int $desiredLevel
	 * @param array $childrenAtThisLevel
	 * @return number|string|Ambigous <string, number>
	 */
	private function findNodeCountAtLevel(&$levelLoop, $desiredLevel, $childrenAtThisLevel = array()){
		if($levelLoop == $desiredLevel){
			print "children at this level : [".implode(',', $childrenAtThisLevel)."]\n";
			print "children count at this level : ".count($childrenAtThisLevel)."\n";
			return count($childrenAtThisLevel);
		}
		
		$childNodesNextLevel = array();
		foreach ($childrenAtThisLevel as $childNodeId){
			$childNodesNextLevel = array_merge($childNodesNextLevel, $this->the_tree[$childNodeId]->getChildren());
		}
		
		if(empty($childNodesNextLevel)){
			//dead end, desired level does not exist
			return "level does not exist";
		}
		
		$levelLoop++;
		return $this->findNodeCountAtLevel($levelLoop, $desiredLevel, $childNodesNextLevel);
	}
	
	/**
	 * public function countNodesAtLevel($fromNodeId, $level)
	 * 
	 * main function to get the count of node at certain level
	 * @param int $fromNodeId
	 * @param int $level - desired level
	 * @return string|Ambigous <number, string, Ambigous>
	 */
	public function countNodesAtLevel($fromNodeId, $level){
		
		if(!isset($this->the_tree[$fromNodeId])){
			return "node id does not exist";
		}
		
		$childrenFromStartNode = $this->the_tree[$fromNodeId]->getChildren();
		$levelIterator = 1; //init the iterator as the direct 1 lvl down this node
		
		return $this->findNodeCountAtLevel($levelIterator, $level, $childrenFromStartNode);
		
	}
	
	/**
	 * public function printTree()
	 * 
	 * print the whole tree (for debug)
	 */
	public function printTree(){
		foreach ($this->the_tree as $nodeId => $nodeObj){
			print "node id $nodeId\n";
			print "children nodes :: [".implode(',', $nodeObj->getChildren())."]\n";
			print "=============================================================\n";
		}
	}
	
}