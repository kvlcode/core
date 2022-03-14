<?php 
class Model_Core_Pager {

	protected $perPageCountOption = [10,20,30,50,100];
    protected $perPageCount = null;
    protected $totalCount = 0;
    protected $pageCount = null;
    protected $start = 1;
    protected $end = null;
    protected $prev = null;
    protected $next = null;
    protected $current = null;
    protected $startLimit = null;
    protected $endLimit = null;

	public function execute($totalCount, $current, $perPageCountOption)
	{
		$this->setPerPageCount($perPageCountOption);
        $this->setPageCount($perPageCountOption);
        $this->setEnd($perPageCountOption);
        $this->setPrev($perPageCountOption);
        $this->setNext($perPageCountOption);
        $this->setCurrent($perPageCountOption);
        $this->setStartLimit($perPageCountOption);
        $this->setEndLimit($perPageCountOption);
        $this->setTotalCount($totalCount);
        $this->setPageCount(ceil($this->getTotalCount() / $this->getPerPageCount()));
        $this->setCurrent(($current > $this->getPageCount()) ? $this->getPageCount() : $current);
        $this->setCurrent(($current < $this->getStart()) ? $this->getStart() : $this->getCurrent());
        $this->setStart(($this->getCurrent() == 1) ? null : 1);
        $this->setEnd(($this->getCurrent() == $this->getPageCount()) ? null : $this->getPageCount());
        $this->setStartLimit($this->getPerPageCount() * ($this->getCurrent() - 1));
        $this->setPrev(($this->getCurrent() == 1) ? null : $this->getCurrent()-1);
        $this->setNext(($this->getCurrent() == $this->getPageCount()) ? null : $this->getCurrent() + 1);

	}

	public function getPerPageCountOption()
    {
        return $this->perPageCountOption;
    }

    public function setPerPageCountOption($perPageCountOption)
    {
        $this->perPageCountOption = $perPageCountOption;
    }

	public function setPerPageCount($perPageCount)
	{
		$this->perPageCount = $perPageCount;
	}

	public function getPerPageCount()
	{
		return $this->perPageCount;
	}

	public function setTotalCount($totalCount)
	{
		$this->totalCount = $totalCount;
	}

	public function getTotalCount()
	{
		return $this->totalCount;
	}

	public function setPageCount($pageCount)
	{
		$this->pageCount = $pageCount;
	}

	public function getPageCount()
	{
		return $this->pageCount;
	}

	public function setStart($start)
	{
		$this->start = $start;
	}

	public function getStart()
	{
		return $this->start;
	}

	public function setEnd($end)
	{
		$this->end = $end;
	}

	public function getEnd()
	{
		return $this->end;
	}

	public function setPrev($prev)
	{
		$this->prev = $prev;
	}

	public function getPrev()
	{
		return $this->prev;
	}

	public function setNext($next)
	{
		$this->next = $next;
	}

	public function getNext()
	{
		return $this->next;
	}

	public function setCurrent($current)
	{
		$this->current = $current;
	}

	public function getCurrent()
	{
		return $this->current;
	}

	public function setStartLimit($startLimit)
	{
		$this->startLimit = $startLimit;
	}

	public function getStartLimit()
	{
		return $this->startLimit;
	}

	public function setEndLimit($endLimit)
	{
		$this->endLimit = $endLimit;
	}

	public function getEndLimit()
	{
		return $this->endLimit;
	}

	public function getAdapter()
	{
		global $adapter;
		return $adapter;
	}
}
