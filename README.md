# Text Adventure Game 

A homegrown engine for building text adventure/interactive fiction games for your browser.

- [X] Parse command strings - Convention: Verb always comes first
- [ ] Create game room objects
- [ ] Develop move command


## Data structures
### Commands
An object of commands with the verb as the key.
```yaml
move:
    description: Move in a given direction, or to a specific room.
    format: <command> <object>
    aliases: [go, walk, run]
```
### Rooms
A markdown file with filename convention ```room_<id number>.md``` and yaml front matter for parameters.
```yaml
---
id: 1
name: Your Studio Apartment
items:
    sofa: item_1
exits:
    north:
        name: bathroom
        id: room_2
        locked: false
    west:
        name: hall
        id: room_3
        locked: true
        key: item_3
---
Using markdown formatting you can describe your studio apartment here including all the objects that you'd like to have interacted with such as your **sofa** with bold lettering.
```

### Items
A markdown file with filename convention ```item_<id number>.md``` and yaml front matter for parameters.
```yaml
---
id: 1
name: Your Sofa
use: You sit down on the sofa and nearly fall through because of a newly broken spring.
reusable: true
weight: 170
size: XL
container: 3
in: false
on:
    pillows: item_4
key: false
---
Your sofa is ugly - something you found at a thrift store. There are several **pillows** scattered across the sofa.
```
**use** - null or a string to display if the item is used.  
**reuseable** - determines if the item can be used again or is 'destroyed'  
**weight** - how much the object weighs to determine if the character lift the object  
**size** - the size slot that is required to store an object in another container (N,T,S,M,L,XL) XL are too large to be placed in a container and N items have no physical existence and cannot be placed inside of a container 
**container** - the number of slots a container has  
**in** - if false, the object cannot hold items inside of it, otherwise is a list of objects inside the item  
**on** - if false, the object cannot have items placed on top of it, otherwise is a list of objects on top of the item  
**key** - if false not a key, otherwise lists the filename of the object it unlocks  
