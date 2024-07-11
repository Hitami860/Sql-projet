<?

class post
{
    private $posts;

    private $titre;

    private $contenu;

    private $auteur;


    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    public function getAuteur()
    {

        return $this->auteur;
    }
}
