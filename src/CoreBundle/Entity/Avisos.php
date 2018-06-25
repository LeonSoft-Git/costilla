<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CoreBundle\Entity\Avisos
 *
 * @ORM\Entity(repositoryClass="CoreBundle\Entity\AvisosRepository")
 * @ORM\Table(name="avisos", indexes={@ORM\Index(name="fk_avisos_usuarios1_idx", columns={"usuarios_id"})})
 */
class Avisos
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    protected $imagen;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $mensaje;

    /**
     * @Gedmo\Slug(separator="-", updatable=true, fields={"nombre"})
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $slug;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $tipo;

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
     * @ORM\OneToMany(targetEntity="Archivos", mappedBy="avisos")
     * @ORM\JoinColumn(name="id", referencedColumnName="avisos_id", nullable=false)
     */
    protected $archivos;

    /**
     * @ORM\OneToMany(targetEntity="Comentarios", mappedBy="avisos")
     * @ORM\JoinColumn(name="id", referencedColumnName="avisos_id", nullable=false)
     */
    protected $comentarios;

    /**
     * @ORM\ManyToOne(targetEntity="Usuarios", inversedBy="avisos")
     * @ORM\JoinColumn(name="usuarios_id", referencedColumnName="id")
     */
    protected $usuarios;

    public function __construct()
    {
        $this->archivos = new ArrayCollection();
        $this->comentarios = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Avisos
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
     * @return \CoreBundle\Entity\Avisos
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
     * Set the value of nombre.
     *
     * @param string $nombre
     * @return \CoreBundle\Entity\Avisos
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
     * Set the value of imagen.
     *
     * @param string $imagen
     * @return \CoreBundle\Entity\Avisos
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
        return $this;
    }
    /**
     * Get the value of imagen.
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of mensaje.
     *
     * @param string $mensaje
     * @return \CoreBundle\Entity\Avisos
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    /**
     * Get the value of mensaje.
     *
     * @return string
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * Set the value of slug.
     *
     * @param string $slug
     * @return \CoreBundle\Entity\Avisos
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }
    /**
     * Get the value of slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the value of tipo.
     *
     * @param integer $tipo
     * @return \CoreBundle\Entity\Avisos
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of tipo.
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\Avisos
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
     * @return \CoreBundle\Entity\Avisos
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
     * @return \CoreBundle\Entity\Avisos
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
     * Add Archivos entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Archivos $archivos
     * @return \CoreBundle\Entity\Avisos
     */
    public function addArchivos(Archivos $archivos)
    {
        $this->archivos[] = $archivos;

        return $this;
    }

    /**
     * Remove Archivos entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Archivos $archivos
     * @return \CoreBundle\Entity\Avisos
     */
    public function removeArchivos(Archivos $archivos)
    {
        $this->archivos->removeElement($archivos);

        return $this;
    }

    /**
     * Get Archivos entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArchivos()
    {
        return $this->archivos;
    }

    /**
     * Add Comentarios entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Comentarios $comentarios
     * @return \CoreBundle\Entity\Avisos
     */
    public function addComentarios(Comentarios $comentarios)
    {
        $this->comentarios[] = $comentarios;

        return $this;
    }

    /**
     * Remove Comentarios entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Comentarios $comentarios
     * @return \CoreBundle\Entity\Avisos
     */
    public function removeComentarios(Comentarios $comentarios)
    {
        $this->comentarios->removeElement($comentarios);

        return $this;
    }

    /**
     * Get Comentarios entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Set Usuarios entity (many to one).
     *
     * @param \CoreBundle\Entity\Usuarios $usuarios
     * @return \CoreBundle\Entity\Avisos
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

    public function __sleep()
    {
        return array('id','nombre','usuarios_id','imagen', 'mensaje','slug', 'tipo', 'activo', 'created_at', 'updated_at');
    }
}