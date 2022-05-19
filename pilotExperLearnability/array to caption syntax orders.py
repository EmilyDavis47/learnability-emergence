def flatten(li):
    return sum(([x] if not isinstance(x, list) else flatten(x)
                for x in li), [])
  
consonants = ['s', 't', 'v', 'k']

#input is a binary array, which can be nested
  #flipHoriz and flipVert = prepositonal interpretations are opposite of default; right and under instead of left and atop
def arrayToCaptionPostNomPrePos(x, flipHoriz, flipVert, names): #x prep y
  caption = ''
  if type(x) == int: 
    caption = str(names[x])
  elif type(x) == list and len(x) == 1:
    caption = arrayToCaptionPostNomPrePos(x[0], flipHoriz, flipVert, names)
  elif type(x) == list and len(x) == 2:
    if type(x[1]) == int or (type(x[1]) == list and len(x[1]) > 1): #[0, [1,2]] or [0,1]
      if flipHoriz == True:
        caption =  arrayToCaptionPostNomPrePos(x[1], flipHoriz, flipVert, names)  + "m"  + arrayToCaptionPostNomPrePos(x[0], flipHoriz, flipVert, names)
      else: 
        caption =  arrayToCaptionPostNomPrePos(x[0], flipHoriz, flipVert, names)  + "m"  + arrayToCaptionPostNomPrePos(x[1], flipHoriz, flipVert, names)
    else: #[0, [1]]
      if flipVert == True:
        caption =  arrayToCaptionPostNomPrePos(x[1], flipHoriz, flipVert, names)  + "r"  + arrayToCaptionPostNomPrePos(x[0], flipHoriz, flipVert, names)
      else: 
        caption =  arrayToCaptionPostNomPrePos(x[0], flipHoriz, flipVert, names)  + "r"  + arrayToCaptionPostNomPrePos(x[1], flipHoriz, flipVert, names)
  return caption

def arrayToCaptionPreNomPostPos(x, flipHoriz, flipVert, names): #backwards of English order
  caption = ''
  if type(x) == int: 
    caption = str(names[x])
  elif type(x) == list and len(x) == 1:
    caption = arrayToCaptionPreNomPostPos(x[0], flipHoriz, flipVert, names)
  elif type(x) == list and len(x) == 2:
    if type(x[1]) == int or (type(x[1]) == list and len(x[1]) > 1): #[0, [1,2]] or [0,1]
      if flipHoriz == True:
        caption =  arrayToCaptionPreNomPostPos(x[0], flipHoriz, flipVert, names)  + "m"  + arrayToCaptionPreNomPostPos(x[1], flipHoriz, flipVert, names)
      else: 
        caption =  arrayToCaptionPreNomPostPos(x[1], flipHoriz, flipVert, names)  + "m"  + arrayToCaptionPreNomPostPos(x[0], flipHoriz, flipVert, names)
    else: #[0, [1]]
      if flipVert == True:
        caption =  arrayToCaptionPreNomPostPos(x[0], flipHoriz, flipVert, names)  + "r"  + arrayToCaptionPreNomPostPos(x[1], flipHoriz, flipVert, names)
      else: 
        caption =  arrayToCaptionPreNomPostPos(x[1], flipHoriz, flipVert, names)  + "r"  + arrayToCaptionPreNomPostPos(x[0], flipHoriz, flipVert, names)
  return caption

import re

def arrayToCaptionCEPre(x, flipHoriz, flipVert, names): #center-embedding, head final
  captionInit = arrayToCaptionPostNomPrePos(x, flipHoriz, flipVert, names)
  preps =r'[mr]'
  nouns = r'['+"".join(names)+']'
  prepsNew = ''.join(re.findall(preps, captionInit))
  nounsNew = ''.join(re.findall(nouns, captionInit))
  caption = prepsNew + nounsNew[::-1]
  return caption


def arrayToCaptionCEPost(x, flipHoriz, flipVert, names): #center-embedding, head initial
  caption = arrayToCaptionCEPre(x, flipHoriz, flipVert, names)[::-1]
  return caption

def arrayToCaptionCrossedPreHeadFirst(x, flipHoriz, flipVert, names): #crossed dependency, head initial and prepositions
  captionInit = arrayToCaptionPostNomPrePos(x, flipHoriz, flipVert, names)
  preps =r'[mr]'
  nouns = r'['+"".join(names)+']'
  prepsNew = ''.join(re.findall(preps, captionInit))
  nounsNew = ''.join(re.findall(nouns, captionInit))
  caption = prepsNew + nounsNew
  return caption

def arrayToCaptionCrossedPostHeadFirst(x, flipHoriz, flipVert, names): #crossed dependency, head final and prepositions
  captionInit = arrayToCaptionPostNomPrePos(x, flipHoriz, flipVert, names)
  preps =r'[mr]'
  nouns = r'['+"".join(names)+']'
  prepsNew = ''.join(re.findall(preps, captionInit))
  nounsNew = ''.join(re.findall(nouns, captionInit))
  caption =  nounsNew + prepsNew
  return caption

def arrayToCaptionCrossedPreHeadLast(x, flipHoriz, flipVert, names): #crossed dependency, head final and prepositions
  captionInit = arrayToCaptionPreNomPostPos(x, flipHoriz, flipVert, names)
  preps =r'[mr]'
  nouns = r'['+"".join(names)+']'
  prepsNew = ''.join(re.findall(preps, captionInit))
  nounsNew = ''.join(re.findall(nouns, captionInit))
  caption = prepsNew + nounsNew
  return caption

def arrayToCaptionCrossedPostHeadLast(x, flipHoriz, flipVert, names): #crossed dependency, head final and prepositions
  captionInit = arrayToCaptionPreNomPostPos(x, flipHoriz, flipVert, names)
  preps =r'[mr]'
  nouns = r'['+"".join(names)+']'
  prepsNew = ''.join(re.findall(preps, captionInit))
  nounsNew = ''.join(re.findall(nouns, captionInit))
  caption = nounsNew + prepsNew 
  return caption

allgrammars = [arrayToCaptionPostNomPrePos, arrayToCaptionPreNomPostPos, arrayToCaptionCEPost, arrayToCaptionCEPre, arrayToCaptionCrossedPreHeadFirst, arrayToCaptionCrossedPostHeadFirst, arrayToCaptionCrossedPreHeadLast, arrayToCaptionCrossedPostHeadLast]
gnames = ['HInitial-noCE', 'HFinal-noCE', 'HInitial-CE', 'HFinal-CE',
          'HInitial-Crossed-PreP', 'HInitial-Crossed-PostP','HFinal-Crossed-PreP', 'HFinal-Crossed-PostP']

flipH = [False, True]
flipV = [False, True]
h = ["Left", "Right"]
v = ["Atop", "Under"]



import pandas as pd
import ast
import csv
import numpy as np
import os, fnmatch

df = pd.read_csv('/Users/emilydavis/Desktop/paper data/pilotExperLearnability/allDataWritePilotLrn1.csv')
arrays = list(df['arrayTraining'])
consonants = list(df['consonants'])
newcolNames = [];
newcols = []
for g in range(len(allgrammars)):
  for b1 in range(len(flipH)):
     for b2 in range(len(flipV)):
        columnName = 'Grammar_'+gnames[g]+"-"+h[b1]+"-"+v[b2]
        newcolNames.append(columnName)
        newColGrammar = []
        for a in range(len(arrays)):
          newColGrammar.append(allgrammars[g](ast.literal_eval(arrays[a]), flipH[b1], flipV[b2], consonants[a]))
        newcols.append(newColGrammar)
for k in range(len(newcolNames)):
  df[newcolNames[k]] = newcols[k]

df.to_csv('/Users/emilydavis/Desktop/paper data/pilotExperLearnability/allDataWritePilotLrn1Gram.csv')       
