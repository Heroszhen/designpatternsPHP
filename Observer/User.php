<?php
namespace Observer;

class User implements \SplSubject{
	private $observers;
	private $lastname;
	private $firstname;
	private $email;

	public function __construct(string $la = null,string $fi = null,string $em = null){
		$this->observers = new \SplObjectStorage();
		$this->lastname = $la;
		$this->firstname = $fi;
		$this->email = $em;
	}

	public function attach(\SplObserver $observer) {
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer) {
        $this->observers->detach($observer);
    }

    public function notify() {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * @return mixed
     */
    public function getLastname():?string
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     *
     * @return self
     */
    public function setLastname(?string $lastname):self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstname():?string
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     *
     * @return self
     */
    public function setFirstname(?string $firstname):self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail():?string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return self
     */
    public function setEmail(?string $email):self
    {
        $this->email = $email;

        return $this;
    }

    public function update(string $la = null,string $fi = null,string $em = null):void{
    	if($la != null)$this->lastname = $la;
    	if($fi != null)$this->firstname = $fi;
    	if($em != null)$this->email = $em;
    	$this->notify();
    }
}