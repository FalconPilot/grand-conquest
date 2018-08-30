/*
**  Local dataset for debug purposes
*/

export const debugData = {

  // User data
  "user": {
    "id": 1,
    "email": "falconpilot@hotmail.fr",
    "username": "FalconPilot",
    "avatar_url": "",
    "personal_api_key": "dLpGyFb1nvW1zZS88Ebe"
  },

  // Nation data
  "nation": {
    "id": 1,
    "name": "Adminland",
    "flag_url": "",
    "manpower": 3000,
    "equipment": [{
      "id": 1,
      "name": "Mosin nagant",
      "image_url": "",
      "description": "A common infantry rifle. Cheap as dirt.",
      "quantity": 1000
    }]
  },

  // Armies data
  "armies": [{
    "id": 1,
    "name": "Admin Army",
    "flag_url": "",
    "squads": [{
      "id": 1,
      "codename": "Seekers",
      "manpower": 1000,
      "equipment": [{
        "id": 1,
        "name": "Mosin nagant",
        "image_url": "",
        "description": "A common infantry rifle. Cheap as dirt.",
        "quantity": 100
      }]
    }]
  }, {
    "id": 2,
    "name": "Quieter Army",
    "flag_url": "",
    "squads": []
  }]
}
