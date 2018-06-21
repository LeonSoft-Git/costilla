<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CoreBundle\Entity\Comentarios
 *
 * @ORM\Entity()
 * @ORM\Table(name="comentarios", indexes={@ORM\Index(name="fk_comentarios_usuarios_idx", columns={"usuarios_id"}), @ORM\Index(name="fk_comentarios_avisos1_idx", columns={"avisos_id"})})
 */
class Comentarios
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=350, nullable=true)
     */
    protected $comentario;

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
     * @ORM\ManyToOne(targetEntity="Usuarios", inversedBy="comentarios")
     * @ORM\JoinColumn(name="usuarios_id", referencedColumnName="id")
     */
    protected $usuarios;

    /**
     * @ORM\ManyToOne(targetEntity="Avisos", inversedBy="comentarios")
     * @ORM\JoinColumn(name="avisos_id", referencedColumnName="id", nullable=false)
     */
    protected $avisos;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Comentarios
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
     * Set the value of usuarios_id.
     *
     * @param integer $usuarios_id
     * @return \CoreBundle\Entity\Comentarios
     */
    public function setUsuariosId($usuarios_id)
    {
        $this->usuarios_id = $usuarios_id;

        return $this;
    }

    /**
     * Get the value of usuarios_id.
     *
     * @return integer
     */
    public function getUsuariosId()
    {
        return $this->usuarios_id;
    }

    /**
     * Set the value of avisos_id.
     *
     * @param integer $avisos_id
     * @return \CoreBundle\Entity\Comentarios
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
     * Set the value of comentario.
     *
     * @param string $comentario
     * @return \CoreBundle\Entity\Comentarios
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get the value of comentario.
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\Comentarios
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
     * @return \CoreBundle\Entity\Comentarios
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
     * @return \CoreBundle\Entity\Comentarios
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
     * Set Usuarios entity (many to one).
     *
     * @param \CoreBundle\Entity\Usuarios $usuarios
     * @return \CoreBundle\Entity\Comentarios
     */
    public function setUsuarios(Usuarios $usuarios = null)
    {
        $this->usuarios = $usuarios;

        return $this;
    }

    /**
     * Get Usuarios entity (many to one).
     *
     * @return \CoreBundle\Entity\Usuarios
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Set Avisos entity (many to one).
     *
     * @param \CoreBundle\Entity\Avisos $avisos
     * @return \CoreBundle\Entity\Comentarios
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
        return array('id', 'usuarios_id', 'avisos_id', 'comentario', 'activo', 'created_at', 'updated_at');
    }
}