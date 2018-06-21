<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CoreBundle\Entity\Contacto
 *
 * @ORM\Entity()
 * @ORM\Table(name="contacto")
 */
class Contacto
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
    protected $email;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    protected $telefono;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $mensaje;

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

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Contacto
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
     * Set the value of email.
     *
     * @param string $email
     * @return \CoreBundle\Entity\Contacto
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of nombre.
     *
     * @param string $nombre
     * @return \CoreBundle\Entity\Contacto
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
     * Set the value of telefono.
     *
     * @param string $telefono
     * @return \CoreBundle\Entity\Contacto
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of telefono.
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of mensaje.
     *
     * @param string $mensaje
     * @return \CoreBundle\Entity\Contacto
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
     * Set the value of created_at.
     *
     * @param \DateTime $created_at
     * @return \CoreBundle\Entity\Contacto
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
     * @return \CoreBundle\Entity\Contacto
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

    public function __sleep()
    {
        return array('id', 'email', 'nombre', 'telefono', 'mensaje', 'created_at', 'updated_at');
    }
}