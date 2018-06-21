<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CoreBundle\Entity\Archivos
 *
 * @ORM\Entity()
 * @ORM\Table(name="archivos", indexes={@ORM\Index(name="fk_archivos_avisos1_idx", columns={"avisos_id"})})
 */
class Archivos
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $pdf;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @Gedmo\Timestampable(on="create", field="creado")
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $created_at;

    /**
     * @Gedmo\Timestampable(on="update", field="actualizado")
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity="Avisos", inversedBy="archivos")
     * @ORM\JoinColumn(name="avisos_id", referencedColumnName="id")
     */
    protected $avisos;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Archivos
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of avisos_id.
     *
     * @param integer $avisos_id
     * @return \CoreBundle\Entity\Archivos
     */
    public function setAvisosId($avisos_id)
    {
        $this->avisos_id = $avisos_id;

        return $this;
    }

    /**
     * Get the value of avisos_id.
     *
     * @return integer
     */
    public function getAvisosId()
    {
        return $this->avisos_id;
    }

    /**
     * Set the value of nombre.
     *
     * @param string $nombre
     * @return \CoreBundle\Entity\Archivos
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of nombre.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of pdf.
     *
     * @param string $pdf
     * @return \CoreBundle\Entity\Archivos
     */
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * Get the value of pdf.
     *
     * @return string
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\Archivos
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get the value of activo.
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set the value of created_at.
     *
     * @param \DateTime $created_at
     * @return \CoreBundle\Entity\Archivos
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of created_at.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of updated_at.
     *
     * @param \DateTime $updated_at
     * @return \CoreBundle\Entity\Archivos
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get the value of updated_at.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set Avisos entity (many to one).
     *
     * @param \CoreBundle\Entity\Avisos $avisos
     * @return \CoreBundle\Entity\Archivos
     */
    public function setAvisos(Avisos $avisos = null)
    {
        $this->avisos = $avisos;

        return $this;
    }

    /**
     * Get Avisos entity (many to one).
     *
     * @return \CoreBundle\Entity\Avisos
     */
    public function getAvisos()
    {
        return $this->avisos;
    }

    public function __sleep()
    {
        return array('id', 'avisos_id', 'nombre', 'pdf', 'activo', 'created_at', 'updated_at');
    }
}